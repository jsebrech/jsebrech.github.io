class Square extends HTMLElement {
    connectedCallback() {
        const button = document.createElement('button');
        button.className = 'square';
        button.textContent = this.getAttribute('value');
        button.onclick = () => this.dispatchEvent(new CustomEvent('squareclick'));
        this.appendChild(button);
    }
};

class Board extends HTMLElement {
    update(xIsNext, squares) {
        const winner = calculateWinner(squares);
        let status;
        if (winner) {
            status = 'Winner: ' + winner;
        } else {
            status = 'Next player: ' + (xIsNext ? 'X' : 'O');
        }

        this.innerHTML = `
            <div class="status">${status}</div>
            <div class="board-row">
                <x-square value="${squares[0]}" data-index="0"></x-square>
                <x-square value="${squares[1]}" data-index="1"></x-square>
                <x-square value="${squares[2]}" data-index="2"></x-square>
            </div>
            <div class="board-row">
                <x-square value="${squares[3]}" data-index="3"></x-square>
                <x-square value="${squares[4]}" data-index="4"></x-square>
                <x-square value="${squares[5]}" data-index="5"></x-square>
            </div>
            <div class="board-row">
                <x-square value="${squares[6]}" data-index="6"></x-square>
                <x-square value="${squares[7]}" data-index="7"></x-square>
                <x-square value="${squares[8]}" data-index="8"></x-square>
            </div>
        `;

        this.querySelectorAll('x-square').forEach(_ => {
            _.addEventListener('squareclick', () => {
                const i = _.dataset.index;
                if (calculateWinner(squares) || squares[i]) return;
                const nextSquares = squares.slice();
                if (xIsNext) {
                    nextSquares[i] = 'X';
                } else {
                    nextSquares[i] = 'O';
                }
                this.dispatchEvent(new CustomEvent('play', { detail: { nextSquares }}));
            });
        });
    }
}

class Game extends HTMLElement {
    #history = [Array(9).fill('')];
    #currentMove = 0;
    get xIsNext() { return this.#currentMove % 2 === 0; }
    get currentSquares() { return this.#history[this.#currentMove]; }
    get board() { return this.querySelector('x-board'); }

    connectedCallback() {
        this.innerHTML = `
            <div class="game">
                <x-board></x-board>
                <div class="game-info">
                    <ol></ol>
                </div>
            </div>
        `;
        this.board.addEventListener('play', this.handlePlay.bind(this))
        this.update();
    }

    handlePlay(e) {
        const { nextSquares } = e.detail;
        const nextHistory = [...this.#history.slice(0, this.#currentMove + 1), nextSquares];
        this.#history = nextHistory;
        this.#currentMove = nextHistory.length - 1;
        this.update();
    }

    update() {
        this.board.update(this.xIsNext, this.currentSquares);

        const moves = this.#history.map((squares, move) => {
            let description;
            if (move > 0) {
                description = 'Go to move #' + move;
            } else {
                description = 'Go to game start';
            }
            return `
                <li>
                    <button data-index="${move}">${description}</button>
                </li>
            `;
        });

        const movesList = this.querySelector('ol');
        movesList.innerHTML = moves.join('');
        movesList.querySelectorAll('button').forEach(button => {
            button.addEventListener('click', () => {
                this.#currentMove = button.dataset.index;
                this.update();
            });
        });
    }
};

export const registerComponents = () => {
    customElements.define('x-square', Square);
    customElements.define('x-board', Board);
    customElements.define('x-game', Game);
}

function calculateWinner(squares) {
    const lines = [
        [0, 1, 2],
        [3, 4, 5],
        [6, 7, 8],
        [0, 3, 6],
        [1, 4, 7],
        [2, 5, 8],
        [0, 4, 8],
        [2, 4, 6],
    ];
    for (let i = 0; i < lines.length; i++) {
        const [a, b, c] = lines[i];
        if (squares[a] && squares[a] === squares[b] && squares[a] === squares[c]) {
        return squares[a];
        }
    }
    return null;
}