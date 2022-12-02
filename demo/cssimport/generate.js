const {rm, mkdir, writeFile} = require('fs/promises')

// directory path
const dir = './public';

(async () => {
    await rm(dir, { recursive: true }).catch(e => {});

    await mkdir(dir);
    await mkdir(`${dir}/imports`);

    let combinedStyles = '';
    let combinedHtml = '';
    let imports = '';

    for (let i = 0; i < 100; i++) {
        const style = `.button-${i} { background-color: rgb(${i}, ${i+100}, 255) }`;
        const html = `<button class="button-${i}">${i}</button>`;
        await writeFile(`${dir}/imports/file${i}.css`, style);
        combinedStyles += style + '\n';
        combinedHtml += html + '\n';
        imports += `@import "./imports/file${i}.css";\n`;
    }

    await writeFile(`${dir}/combined.css`, combinedStyles);

    await writeFile(`${dir}/combined.html`, 
    `<html>
    <head>
        <link rel="stylesheet" href="combined.css">
    </head>
    <body>
        ${combinedHtml}
    </body>
    </html>`);

    await writeFile(`${dir}/separate.css`, imports);

    await writeFile(`${dir}/separate.html`, 
    `<html>
    <head>
        <link rel="stylesheet" href="separate.css">
    </head>
    <body>
        ${combinedHtml}
    </body>
    </html>`);

})();
