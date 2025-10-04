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

// --- Preenche zeros automaticamente se houver células vazias ---
function preencherZerosSeNecessario() {
    let matrizA = document.querySelectorAll('#matriz-container-A input');
    let matrizB = document.querySelectorAll('#matriz-container-B input');

    let linhasA = parseInt(document.getElementById('sizeA').value);
    let colunasA = linhasA; // supondo matriz quadrada
    let linhasB = parseInt(document.getElementById('sizeB').value);
    let colunasB = linhasB; // supondo matriz quadrada

    let vazioA = Array.from(matrizA).some(input => input.value.trim() === '');
    let vazioB = Array.from(matrizB).some(input => input.value.trim() === '');

    if (vazioA || vazioB) {
        matrizA.forEach(input => { if (input.value.trim() === '') input.value = '0'; });
        matrizB.forEach(input => { if (input.value.trim() === '') input.value = '0'; });

        Swal.fire({
            icon: 'info',
            title: 'Aviso',
            text: 'Algumas células vazias foram preenchidas automaticamente com 0.'
        });
    }
}

function validarMatrizes() {
    const operacao = document.querySelector('select[name="operacao"]').value;

    // Obter dimensões reais
    const linhasA = parseInt(document.getElementById('sizeA').value);
    const colunasA = document.querySelectorAll('#matriz-container-A input[name^="matrizA[0]"]').length;
    const linhasB = parseInt(document.getElementById('sizeB').value);
    const colunasB = document.querySelectorAll('#matriz-container-B input[name^="matrizB[0]"]').length;

    // Remove destaques anteriores
    document.getElementById('matriz-container-A').classList.remove('erro-matriz');
    document.getElementById('matriz-container-B').classList.remove('erro-matriz');

    // Validação de compatibilidade
    if (operacao === 'adicao' || operacao === 'subtracao') {
        if (linhasA !== linhasB || colunasA !== colunasB) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'As matrizes devem ter o mesmo tamanho, o mesmo número de linhas e colunas.'
            });

            // Destacar ambas as matrizes
            document.getElementById('matriz-container-A').classList.add('erro-matriz');
            document.getElementById('matriz-container-B').classList.add('erro-matriz');
            return false;
        }
    } else if (operacao === 'multiplicacao') {
        if (colunasA !== linhasB) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'O número de colunas da matriz da esquerda deve ser igual número de linhas da matriz da direita.'
            });

            // Destacar ambas as matrizes
            document.getElementById('matriz-container-A').classList.add('erro-matriz');
            document.getElementById('matriz-container-B').classList.add('erro-matriz');
            return false;
        }
    }

    // Se passou na validação, preenche zeros automaticamente
    preencherZerosSeNecessario();

    return true; // permite o envio do formulário
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
