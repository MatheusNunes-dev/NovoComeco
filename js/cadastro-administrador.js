    // Função para buscar o endereço via CEP
    async function buscarEnderecoPorCEP(cep) {
        // Faz a requisição para a API do ViaCEP
        const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);

        if (!response.ok) {
            console.error('Erro ao buscar o CEP');
            return;
        }

        const dados = await response.json();

        // Verifica se o CEP é válido
        if (dados.erro) {
            alert('CEP inválido!');
            return;
        }

        // Preenche os campos com os dados retornados pela API
        document.getElementById('bairro').value = dados.bairro;
        document.getElementById('cidade').value = dados.localidade;
        document.getElementById('estado').value = dados.uf;
    }

    // Função que será chamada quando o usuário digitar o CEP
    document.getElementById('cep').addEventListener('input', function () {
        const cep = this.value.replace(/\D/g, ''); // Remove qualquer caractere não numérico

        // Se o CEP tiver 8 caracteres, busca o endereço
        if (cep.length === 8) {
            buscarEnderecoPorCEP(cep);
        }
    });

    // Função para validar as senhas
    document.querySelector('form').addEventListener('submit', function (event) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm-password').value;

        // Verifica se as senhas coincidem
        if (password !== confirmPassword) {
            alert('As senhas não coincidem. Por favor, tente novamente.');
            event.preventDefault(); // Impede o envio do formulário
        }

        // Valida CPF
        const cpf = document.getElementById('cpf').value.replace(/\D/g, ''); // Remove qualquer caractere não numérico
        if (cpf.length !== 11) {
            alert('CPF inválido! Por favor, insira um CPF com 11 dígitos.');
            event.preventDefault();
            return;
        }

        // Valida Telefone
        const telefone = document.getElementById('phone').value.replace(/\D/g, ''); // Remove qualquer caractere não numérico
        if (telefone.length !== 11) {
            alert('Telefone inválido! Por favor, insira um número de telefone válido com 11 dígitos.');
            event.preventDefault();
            return;
        }

        // Valida CEP
        const cepInput = document.getElementById('cep').value.replace(/\D/g, ''); // Remove qualquer caractere não numérico
        if (cepInput.length !== 8) {
            alert('CEP inválido! Por favor, insira um CEP válido com 8 dígitos.');
            event.preventDefault();
            return;
        }
    });

    // Função para permitir somente números
    function validarSomenteNumeros(event) {
        const campo = event.target;
        campo.value = campo.value.replace(/\D/g, ''); // Remove qualquer caractere não numérico
    }

    // Função para validar o nome (somente letras e espaços)
    function validarNome(event) {
        const campo = event.target;
        campo.value = campo.value.replace(/[^a-zA-Z\s]/g, ''); // Remove qualquer número ou caractere especial
    }


    // Validações de campos: CPF, Telefone, CEP, Nome e Número
    document.getElementById('cpf').addEventListener('input', validarSomenteNumeros);
    document.getElementById('phone').addEventListener('input', validarSomenteNumeros);
    document.getElementById('cep').addEventListener('input', validarSomenteNumeros);
    document.getElementById('name').addEventListener('input', validarNome);
    document.getElementById('numero').addEventListener('input', validarSomenteNumeros);

    