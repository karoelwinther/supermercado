<?php
// Verificar se a chave 'num_lojas' existe no array $_POST
if(isset($_POST['num_lojas'])) {
    // Se a chave existe, então pode acessar seu valor com segurança
    $num_lojas = $_POST['num_lojas'];
    // Restante do seu código aqui
} else {
    // Se a chave 'num_lojas' não existe, defina um valor padrão ou trate o erro de acordo
    echo "A chave 'num_lojas' não está definida no array \$_POST.";
}
?>
