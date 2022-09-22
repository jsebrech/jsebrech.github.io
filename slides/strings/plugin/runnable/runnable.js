(function() {
    var runText = 'Run';
    var returnText = 'Return';

    var onButtonClick = function() {
        if (this.nextAction === 'run') {
            this.nextAction = 'return';
            this.codeElem.style.display = 'none';
            this.consoleElem.style.display = 'block';
            this.firstChild.nodeValue = returnText;
            var code = this.codeElem.innerText;
            var output = '\n' + executeCode(code);
            this.consoleElem.innerHTML = '';
            this.consoleElem.appendChild(document.createTextNode(output));
        } else {
            this.nextAction = 'run';
            this.codeElem.style.display = 'block';
            this.consoleElem.style.display = 'none';
            this.firstChild.nodeValue = runText;
        }
    };

    var executeCode = function(code) {
        var output = '';
        var interceptor = {
            log: function() {
                console.log(arguments);
                for (var i = 0; i < arguments.length; i++) {
                    switch (typeof arguments[i]) {
                        case 'object':
                        /* falls through */
                        case 'array':
                            output += JSON.stringify(arguments[i], null, 2) + '\n';
                            break;
                        default:
                            output += arguments[i] + '\n';
                            break;
                    }
                }
            }
        };
        (function() {
            var console;
            console = interceptor;
            try {
                eval(code);
            } catch (e) {
                console.log(e.message || e);
            }
        })();
        return output;
    };

    var makeRunnable = function(element) {
        var runButton = document.createElement('button');
        runButton.appendChild(document.createTextNode(runText));
        runButton.style.position = 'absolute';
        runButton.style.right = '20px';
        runButton.style.top = '10px';
        runButton.style.fontSize = '120%';
        runButton.codeElem = element;
        runButton.nextAction = 'run';
        element.parentNode.appendChild(runButton);
        runButton.addEventListener('click', onButtonClick, false);

        var consoleTarget = document.createElement('code');
        consoleTarget.style.display = 'none';
        consoleTarget.style.minHeight = '3em';
        runButton.consoleElem = consoleTarget;
        element.parentNode.appendChild(consoleTarget);
    };

    [].slice.call( document.querySelectorAll( 'pre code.runnable' ) ).forEach( makeRunnable );
})();
