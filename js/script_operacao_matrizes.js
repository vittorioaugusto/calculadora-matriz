function atualizarMatriz(matriz) {
    let size = parseInt(document.getElementById('size' + matriz).value);
    let matrizContainer = document.getElementById('matriz-container-' + matriz);
    
    matrizContainer.innerHTML = '';
    matrizContainer.style.display = 'grid';
    matrizContainer.style.gridTemplateColumns = `repeat(${size}, 40px)`;

    for (let i = 0; i < size; i++) {
        for (let j = 0; j < size; j++) {
            let input = document.createElement('input');
            input.type = 'text';
            input.name = `matriz${matriz}[${i}][${j}]`;
            input.value = '';
            matrizContainer.appendChild(input);
        }
    }
}


function alterarMatriz(matriz, acao) {
    let sizeInput = document.getElementById('size' + matriz);
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
                alert('A Matriz A contém valores inválidos. Digite apenas números.');
                return false;
            }
        }
    }

    for (let input of matrizB) {
        const valor = input.value.trim();
        if (valor !== '') {
            preenchidoB = true;
            if (isNaN(valor)) {
                alert('A Matriz B contém valores inválidos. Digite apenas números.');
                return false;
            }
        }
    }

    if (!preenchidoA || !preenchidoB) {
        alert('Por favor, preencha pelo menos um dado na Matriz A e na Matriz B.');
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
                    alert('A matriz contém valores inválidos. Digite apenas números.');
                    return false;
                }
            }
        }

        if (!preenchido) {
            alert('Por favor, preencha pelo menos um valor na matriz.');
            return false;
        }

        return true;
    }

atualizarMatriz('A');
atualizarMatriz('B');