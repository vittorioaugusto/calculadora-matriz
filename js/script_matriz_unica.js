function gerarMatriz(matriz) {
    let size = parseInt(document.getElementById('size' + matriz).value);
    let matrizContainer = document.getElementById('matriz-container-' + matriz);

    matrizContainer.innerHTML = '';
    matrizContainer.style.display = 'grid';
    matrizContainer.style.gridTemplateColumns = `repeat(${size}, 40px)`;
    matrizContainer.style.gap = '6px';

    for (let i = 0; i < size; i++) {
        for (let j = 0; j < size; j++) {
            let input = document.createElement('input');
            input.type = 'text';
            input.name = `matriz${matriz}[${i}][${j}]`;
            input.value = '';
            input.classList.add('matriz-celula');
            matrizContainer.appendChild(input);
        }
    }
}

function alterarMatriz(matriz, acao) {
    const sizeInput = document.getElementById("size" + matriz);
    let size = parseInt(sizeInput.value) || 3;

    if (acao === 'add' && size < 10) size++;
    if (acao === 'remove' && size > 2) size--;

    sizeInput.value = size;
    gerarMatriz(matriz);
}

function limparMatriz(matriz) {
    const container = document.getElementById("matriz-container-" + matriz);
    const inputs = container.querySelectorAll("input");
    inputs.forEach(input => input.value = '');
}

// Inicialização 
document.addEventListener("DOMContentLoaded", () => {
    gerarMatriz('A');
});