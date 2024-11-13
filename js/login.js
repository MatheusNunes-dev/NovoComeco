document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const emailInput = document.querySelector('#email');
    const senhaInput = document.querySelector('#password');
    const emailError = document.createElement('p');
    const senhaError = document.createElement('p');
    
    // Adiciona os elementos de erro ao DOM
    emailError.style.color = '#FF4D4D';
    senhaError.style.color = '#FF4D4D';
    emailInput.parentElement.appendChild(emailError);
    senhaInput.parentElement.appendChild(senhaError);

    // Função de validação do formulário
    function validateForm(event) {
        let valid = true;

        // Normaliza o email para letras minúsculas
        emailInput.value = emailInput.value.toLowerCase().trim();

        // Validações de email
        if (emailInput.value === '') {
            emailError.textContent = 'O campo de email é obrigatório.';
            emailInput.style.borderColor = '#FF4D4D'; // Vermelho
            valid = false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value)) {
            emailError.textContent = 'Insira um email válido.';
            emailInput.style.borderColor = '#FF4D4D';
            valid = false;
        } else {
            emailError.textContent = ''; // Limpa mensagem de erro
            emailInput.style.borderColor = '#ccc'; // Resetando a borda
        }

        // Validações de senha
        if (senhaInput.value === '') {
            senhaError.textContent = 'O campo de senha é obrigatório.';
            senhaInput.style.borderColor = '#FF4D4D'; // Vermelho
            valid = false;
        } else if (senhaInput.value.length < 6) {
            senhaError.textContent = 'A senha deve ter pelo menos 6 caracteres.';
            senhaInput.style.borderColor = '#FF4D4D';
            valid = false;
        } else {
            senhaError.textContent = ''; // Limpa mensagem de erro
            senhaInput.style.borderColor = '#ccc'; // Resetando a borda
        }

        if (!valid) {
            event.preventDefault(); // Impede o envio do formulário se houver erro
        }
    }

    // Aplica a validação ao submeter o formulário
    form.addEventListener('submit', validateForm);
});
