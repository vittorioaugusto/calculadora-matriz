function atualizarMatriz() {
    let size = parseInt(document.getElementById('size').value);
    let matrizContainer = document.getElementById('matriz-container');
    matrizContainer.innerHTML = '';

    for (let i = 0; i < size; i++) {
        let row = document.createElement('div');
        for (let j = 0; j < size; j++) {
            let input = document.createElement('input');
            input.type = 'text';
            input.name = `a${i + 1}${j + 1}`;
            input.value = document.querySelector(`[name="a${i + 1}${j + 1}"]`)?.value || '';
            row.appendChild(input);
            row.innerHTML += ` x${j + 1} `;
            if (j < size - 1) row.innerHTML += ' + ';
        }
        let resultInput = document.createElement('input');
        resultInput.type = 'text';
        resultInput.name = `r${i + 1}`;
        resultInput.value = document.querySelector(`[name="r${i + 1}"]`)?.value || '';
        row.innerHTML += ` = `;
        row.appendChild(resultInput);
        matrizContainer.appendChild(row);
    }
}

function alterarMatriz(acao) {
    let sizeInput = document.getElementById('size');
    let size = parseInt(sizeInput.value);
    if (acao === 'add') size++;
    if (acao === 'remove' && size > 2) size--;
    sizeInput.value = size;
    atualizarMatriz();
}

function limparMatriz() {
    let inputs = document.querySelectorAll('#matriz-container input');
    inputs.forEach(input => input.value = '');
}

atualizarMatriz();