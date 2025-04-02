function atualizarMatriz() {
    let size = parseInt(document.getElementById('size').value);
    let matrizContainer = document.getElementById('matriz-container');
    matrizContainer.innerHTML = '';

    for (let i = 0; i < size; i++) {
        let row = '';
        for (let j = 0; j < size; j++) {
            row += `<input type="text" name="a${i + 1}${j + 1}" value=""> x${j + 1}`;
            if (j < size - 1) row += ' + ';
        }
        row += ` = <input type="text" name="r${i + 1}" value=""><br>`;
        matrizContainer.innerHTML += row;
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