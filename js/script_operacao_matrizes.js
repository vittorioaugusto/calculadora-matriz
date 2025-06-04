function atualizarMatriz(matriz) {
    let sizeInput = document.getElementById('size' + matriz);
    if (!sizeInput) return;

    let size = parseInt(sizeInput.value);
    let matrizContainer = document.getElementById('matriz-container-' + matriz);
    if (!matrizContainer) return;

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

    verificarLayoutResponsivo();
}

function alterarMatriz(matriz, acao) {
    let sizeInput = document.getElementById('size' + matriz);
    if (!sizeInput) return;

    let size = parseInt(sizeInput.value);
    if (acao === 'add') size++;
    if (acao === 'remove' && size > 2) size--;
    sizeInput.value = size;
    atualizarMatriz(matriz);
}

function limparMatriz(matriz) {
    let inputs = document.querySelectorAll(`#matriz-container-${matriz} input`);
    inputs.forEach(input => input.value = '');
}

function validarMatrizes() {
    let matrizA = document.querySelectorAll('#matriz-container-A input');
    let matrizB = document.querySelectorAll('#matriz-container-B input');

    let preenchidoA = false;
    let preenchidoB = false;

    for (let input of matrizA) {
        const valor = input.value.trim();
        if (valor !== '') {
            preenchidoA = true;
            if (isNaN(valor)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: 'A Matriz A contém valores inválidos. Digite apenas números.'
                });
                return false;
            }
        }
    }

    for (let input of matrizB) {
        const valor = input.value.trim();
        if (valor !== '') {
            preenchidoB = true;
            if (isNaN(valor)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: 'A Matriz B contém valores inválidos. Digite apenas números.'
                });
                return false;
            }
        }
    }

    if (!preenchidoA || !preenchidoB) {
        Swal.fire({
            icon: 'warning',
            title: 'Atenção',
            text: 'Por favor, preencha pelo menos um dado na Matriz A e na Matriz B.'
        });
        return false;
    }

    return true;
}

function validarMatrizEscalar() {
    const inputs = document.querySelectorAll('#matriz-container-A input');
    let preenchido = false;

    for (let input of inputs) {
        const valor = input.value.trim();
        if (valor !== '') {
            preenchido = true;
            if (isNaN(valor)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: 'A matriz contém valores inválidos. Digite apenas números.'
                });
                return false;
            }
        }
    }

    if (!preenchido) {
        Swal.fire({
            icon: 'warning',
            title: 'Atenção',
            text: 'Por favor, preencha pelo menos um valor na matriz.'
        });
        return false;
    }

    return true;
}

function verificarLayoutResponsivo() {
    const sizeAInput = document.getElementById('sizeA');
    const sizeBInput = document.getElementById('sizeB');
    const wrapper = document.getElementById('matrizes-wrapper');

    if (!sizeAInput || !sizeBInput || !wrapper) return;

    const sizeA = parseInt(sizeAInput.value);
    const sizeB = parseInt(sizeBInput.value);

    if (sizeA > 3 || sizeB > 3) {
        wrapper.classList.add('vertical');
        wrapper.classList.remove('horizontal');
    } else {
        wrapper.classList.add('horizontal');
        wrapper.classList.remove('vertical');
    }
}

// Inicialização
document.addEventListener('DOMContentLoaded', () => {
    atualizarMatriz('A');
    atualizarMatriz('B');
});
