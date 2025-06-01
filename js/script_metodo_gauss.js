function atualizarMatriz() {
    let size = parseInt(document.getElementById('size').value);
    let matrizContainer = document.getElementById('matriz-container');
    matrizContainer.innerHTML = '';

    const fragment = document.createDocumentFragment();

    // Loop para cada linha (equação)
    for (let i = 0; i < size; i++) {
        const linhaMatrizDiv = document.createElement('div');
        linhaMatrizDiv.classList.add('linha-matriz'); // Adiciona uma classe para estilização

        // Loop para os termos de cada equação (coeficientes e variáveis)
        for (let j = 0; j < size; j++) {
            // Input para o coeficiente (a_ij)
            const inputCoef = document.createElement('input');
            inputCoef.type = 'number'; // Sugestão: Alterar para 'number' para entrada numérica
            inputCoef.classList.add('matriz-celula'); // Classe para estilização
            inputCoef.name = `a${i + 1}${j + 1}`; // Nomes dos campos: a11, a12, etc.
            inputCoef.value = ''; // Garante que o valor inicial seja vazio
            inputCoef.placeholder = `coef ${j + 1}`; // Placeholder para guia
            linhaMatrizDiv.appendChild(inputCoef);

            // Span para a variável (x1, x2, etc.)
            const spanVariavel = document.createElement('span');
            spanVariavel.classList.add('variavel'); // Classe para estilização
            spanVariavel.textContent = `x${j + 1}`;
            linhaMatrizDiv.appendChild(spanVariavel);

            // Span para o sinal de '+' entre os termos (exceto o último)
            if (j < size - 1) {
                const spanSinalPlus = document.createElement('span');
                spanSinalPlus.classList.add('sinal'); // Classe para estilização
                spanSinalPlus.textContent = ' + '; // Adiciona espaços para melhor legibilidade
                linhaMatrizDiv.appendChild(spanSinalPlus);
            }
        }

        // Span para o sinal de '='
        const spanSinalIgual = document.createElement('span');
        spanSinalIgual.classList.add('sinal'); // Classe para estilização
        spanSinalIgual.textContent = ' = '; // Adiciona espaços para melhor legibilidade
        linhaMatrizDiv.appendChild(spanSinalIgual);

        // Input para o termo independente (r_i)
        const inputResultado = document.createElement('input');
        inputResultado.type = 'number';
        inputResultado.classList.add('matriz-celula'); // Classe para estilização
        inputResultado.name = `r${i + 1}`; // Nomes dos campos: r1, r2, etc.
        inputResultado.value = ''; // Garante que o valor inicial seja vazio
        inputResultado.placeholder = `res ${i + 1}`; // Placeholder para guia
        linhaMatrizDiv.appendChild(inputResultado);

        fragment.appendChild(linhaMatrizDiv); // Adiciona a linha ao fragmento
    }

    matrizContainer.appendChild(fragment); // Adiciona o fragmento ao DOM de uma vez
}

function alterarMatriz(acao) {
    let sizeInput = document.getElementById('size');
    let size = parseInt(sizeInput.value);

    if (acao === 'add') {
        size++;
    } else if (acao === 'remove') {
        if (size > 2) { // Garante que o tamanho mínimo seja 2x2
            size--;
        } else {
            // Avisar o usuário que não pode remover mais linhas
            alert("O sistema deve ter no mínimo 2 equações.");
            return; // Sai da função se não puder remover
        }
    }
    
    sizeInput.value = size;
    atualizarMatriz();
}

function limparMatriz() {
    let inputs = document.querySelectorAll('#matriz-container input');
    inputs.forEach(input => input.value = '');
}

// Atualiza matriz na inicialização quando o DOM estiver pronto
document.addEventListener('DOMContentLoaded', atualizarMatriz);