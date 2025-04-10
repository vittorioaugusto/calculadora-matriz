function atualizarMatriz() {
    let size = parseInt(document.getElementById('size').value);
    let matrizContainer = document.getElementById('matriz-container');
    matrizContainer.innerHTML = '';

    let html = '<div class="matriz-identificada">';

    for (let i = 0; i < size; i++) {
        html += '<div class="linha-matriz">';
        for (let j = 0; j < size; j++) {
            html += `<input type="text" class="input-matriz" name="a${i + 1}${j + 1}" value="">`;
            html += `<span class="variavel">x${j + 1}</span>`;
            if (j < size - 1) html += '<span class="sinal"> + </span>';
        }
        html += '<span class="sinal"> = </span>';
        html += `<input type="text" class="input-resultado" name="r${i + 1}" value="">`;
        html += '</div>';
    }

    html += '</div>';
    matrizContainer.innerHTML = html;
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

// Atualiza matriz na inicialização
document.addEventListener('DOMContentLoaded', atualizarMatriz);
