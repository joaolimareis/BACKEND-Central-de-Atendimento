<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );
$SERVER = "localhost";
$USER = "central";
$SENHA = "######";
$NAMEDB = "central";


/**
 * Função para gerar nova senha
 */
function novasenha($conn, $prefix,$Atendimento) {
    date_default_timezone_set('America/Sao_Paulo'); // Defina o fuso horário

    // Obtenha a data e hora atual
    $date = date('Y-m-d H:i:s');

    // Obtenha o último código gerado
    $result = mysqli_query($conn, "SELECT ultimo_codigo FROM wp_ultimo_codigo ORDER BY id DESC LIMIT 1");
    $row = mysqli_fetch_assoc($result);

    // Incrementar o valor do código
    $ultimo_codigo = $row ? $row['ultimo_codigo'] : $prefix . '000';
    $numero = (int)substr($ultimo_codigo, 1) + 1;
    $codigo = $prefix . str_pad($numero, 3, '0', STR_PAD_LEFT);

    // Insira o novo código na tabela de atendimentos
    $cadastro = "INSERT INTO `wp_atendimentos` (`id`, `tipoDeAtendimento`, `dataHoraAtendimento`, `chamado`, `compareceu`, `codigoAtendimento`, `Horachamado`, `Atendente`, `Guinche`, `Encerrado`,`HoraEncerramento`)
                 VALUES (NULL, '$Atendimento', '$date', 0, NULL, '$codigo', NULL, NULL, NULL, 0,Null)";
    $envio = mysqli_query($conn, $cadastro);

    // Atualize o último código gerado
    mysqli_query($conn, "INSERT INTO wp_ultimo_codigo (ultimo_codigo) VALUES ('$codigo')");

    return $codigo; // Retorna o código gerado
}

/**
 * Shortcode para gerar nova senha de matrícula
 */
function novasenhacompl() {
    global $SERVER, $USER, $SENHA, $NAMEDB;
    $conn = mysqli_connect($SERVER, $USER, $SENHA, $NAMEDB);

    ob_start();
    ?>

    <form method="post">
        <input type="submit" name="gerarSenhaMatricula" value="Matrícula">
    </form>

    <?php
    // Verifica se o botão "Gerar Nova Senha de Matrícula" foi clicado
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['gerarSenhaMatricula'])) {
        // Verifica se há conexão com o banco de dados
        if ($conn->connect_error) {
            die('Erro de conexão: ' . $conn->connect_error);
        }

        // Gera a nova senha de matrícula
        $codigoGerado = novasenha($conn, 'M','Matricula'); // Chama a função e armazena o código gerado
		if ($codigoGerado) {
			$_SESSION['nova_senha'] = "Senha gerada com sucesso:<h1> $codigoGerado</h1>"; // Armazena a mensagem na sessão
		} else {
			$_SESSION['nova_senha'] = "Erro ao gerar nova senha de Matricula: " . $conn->error;
		}

        // Feche a conexão com o banco de dados
        $conn->close();
    }

    return ob_get_clean();
}
add_shortcode('gerar_nova_senha', 'novasenhacompl');

/**
 * Shortcode para gerar nova senha de financeiro
 */
function novasenhacomp2() {
    global $SERVER, $USER, $SENHA, $NAMEDB;
    $conn = mysqli_connect($SERVER, $USER, $SENHA, $NAMEDB);

    ob_start();
    ?>

    <form method="post">
        <input type="submit" name="gerarSenhaFinanceiro" value="Financeiro">
    </form>

    <?php
    // Verifica se o botão "Gerar Nova Senha de Financeiro" foi clicado
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['gerarSenhaFinanceiro'])) {
        // Verifica se há conexão com o banco de dados
        if ($conn->connect_error) {
            die('Erro de conexão: ' . $conn->connect_error);
        }

        // Gera a nova senha de financeiro
        $codigoGerado = novasenha($conn, 'F','Financeiro'); // Chama a função e armazena o código gerado
		if ($codigoGerado) {
			$_SESSION['nova_senha'] = "Senha gerada com sucesso: <h1> $codigoGerado</h1>"; // Armazena a mensagem na sessão
		} else {
			$_SESSION['nova_senha'] = "Erro ao gerar nova senha de Financeiro: " . $conn->error;
		}

        // Feche a conexão com o banco de dados
        $conn->close();
    }

    return ob_get_clean();
}
add_shortcode('gerar_nova_senha_financa', 'novasenhacomp2');

function NovaSenhaFilantropia() {
    global $SERVER, $USER, $SENHA, $NAMEDB;
    $conn = mysqli_connect($SERVER, $USER, $SENHA, $NAMEDB);

    ob_start();
    ?>

    <form method="post">
        <input type="submit" name="gerarSenhaFilantropia" value="Filantropia">
    </form>

    <?php
    // Verifica se o botão "Gerar Nova Senha de Filantropia" foi clicado
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['gerarSenhaFilantropia'])) {
        // Verifica se há conexão com o banco de dados
        if ($conn->connect_error) {
            die('Erro de conexão: ' . $conn->connect_error);
        }

        // Gera a nova senha de Filantropia
        $codigoGerado = novasenha($conn, 'B','Filantropia'); // Chama a função e armazena o código gerado
		if ($codigoGerado) {
			$_SESSION['nova_senha'] = "Senha  gerada com sucesso: <h1> $codigoGerado</h1>"; // Armazena a mensagem na sessão
		} else {
			$_SESSION['nova_senha'] = "Erro ao gerar nova senha de Filantropia: " . $conn->error;
		}

        // Feche a conexão com o banco de dados
        $conn->close();
    }

    return ob_get_clean();
}
add_shortcode('nova_senha_filantropia', 'NovaSenhaFilantropia');


function NovaSenhaSecretaria() {
    global $SERVER, $USER, $SENHA, $NAMEDB;
    $conn = mysqli_connect($SERVER, $USER, $SENHA, $NAMEDB);

    ob_start();
    ?>

    <form method="post">
        <input type="submit" name="gerarSenhaSecretaria" value="Secretaria">
    </form>

    <?php
    // Verifica se o botão "Gerar Nova Senha de Secretaria" foi clicado
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['gerarSenhaSecretaria'])) {
        // Verifica se há conexão com o banco de dados
        if ($conn->connect_error) {
            die('Erro de conexão: ' . $conn->connect_error);
        }

        // Gera a nova senha de Secretaria
        $codigoGerado = novasenha($conn, 'S','Secretaria'); // Chama a função e armazena o código gerado
		if ($codigoGerado) {
			$_SESSION['nova_senha'] = "Senha gerada com sucesso:<h1> $codigoGerado</h1>"; // Armazena a mensagem na sessão
		} else {
			$_SESSION['nova_senha'] = "Erro ao gerar nova senha de Secretaria: " . $conn->error;
		}

        // Feche a conexão com o banco de dados
        $conn->close();
    }

    return ob_get_clean();
}
add_shortcode('nova_senha_secretaria', 'NovaSenhaSecretaria');
/**
 * Shortcode para resetar a contagem
 */
function botaozeraratendimento() {
    global $SERVER, $USER, $SENHA, $NAMEDB;
    $conn = mysqli_connect($SERVER, $USER, $SENHA, $NAMEDB);

    ob_start();
    ?>

    <form method="post" onsubmit="return confirmReset();">
        <input type="submit" name="resetarContagem" value="Resetar Contagem">
    </form>

    <script type="text/javascript">
        function confirmReset() {
            return confirm("Tem certeza que deseja resetar a contagem e encerrar todas as senhas?");
        }
    </script>

    <?php
    // Verifica se o botão "Resetar Contagem" foi clicado
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['resetarContagem'])) {
        // Verifica se há conexão com o banco de dados
        if ($conn->connect_error) {
            die('Erro de conexão: ' . $conn->connect_error);
        }

        // Função para resetar a contagem e atualizar senhas
        function resetarContagem($conn) {
            // Atualiza as senhas com chamado = 0, definindo Encerrado = 1
            $update = "UPDATE wp_atendimentos SET Encerrado = 1 WHERE chamado = 0";
            $resultadoAtualizacao = mysqli_query($conn, $update);
            
            // Em seguida, trunca a tabela wp_ultimo_codigo
            $reset = mysqli_query($conn, "TRUNCATE TABLE wp_ultimo_codigo");
            
            return $resultadoAtualizacao && $reset;
        }

        // Verifica se a função resetarContagem() foi executada ao enviar o formulário
        if (resetarContagem($conn)) {
           
        } else {
            echo "<p>Erro ao resetar contagem: " . $conn->error . "</p>";
        }

        // Feche a conexão com o banco de dados
        $conn->close();
    }

    return ob_get_clean();
}
add_shortcode('resetar_contagem', 'botaozeraratendimento');


// functions.php

function enqueue_ajax_script() {
    wp_enqueue_script('ajax-script', get_stylesheet_directory_uri() . '/js/ajax-script.js', array('jquery'), '1.0', true);
    wp_localize_script('ajax-script', 'ajax_params', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_ajax_script');


function fetch_atendimentos() {
    global $wpdb;
    $output = '';

    $results = $wpdb->get_results("SELECT * FROM wp_atendimentos WHERE chamado = 0 AND encerrado = 0", ARRAY_A);

    if ($results) {
        foreach ($results as $dado) {
            $codigoAtendimento = $dado["codigoAtendimento"];
            $dataHoraAtendimento = $dado["dataHoraAtendimento"];
            $tempoEspera = calcularTempoEspera($dataHoraAtendimento);

            $output .= '<h1>' . $codigoAtendimento . ' - Tempo de espera: ' . $tempoEspera . '</h1>';
        }
    } else {
        $output = '<h1>Não há senhas.</h1>';
    }

    wp_send_json_success($output);
}

function calcularTempoEspera($dataHoraAtendimento) {
    $dataHoraAtendimento = new DateTime($dataHoraAtendimento);
    $agora = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));

    $intervalo = $dataHoraAtendimento->diff($agora);

    return sprintf("%02d:%02d", $intervalo->i, $intervalo->s);
}

add_action('wp_ajax_fetch_atendimentos', 'fetch_atendimentos');
add_action('wp_ajax_nopriv_fetch_atendimentos', 'fetch_atendimentos');




function custom_atendimentos_shortcode() {
    ob_start();
    ?>
    <div id="atendimentos-container"></div>
    <script type="text/javascript">
        function fetchAtendimentos() {
            jQuery.ajax({
                url: ajax_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'fetch_atendimentos'
                },
                success: function(response) {
                    jQuery('#atendimentos-container').html(response.data);
                }
            });
        }
        fetchAtendimentos();
        setInterval(fetchAtendimentos, 5000); // Update every 5 seconds
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('listar_atendimentos', 'custom_atendimentos_shortcode');

function ver_senhas_chamadas_shortcode() {
    ob_start();
    ?>
    <div id="senhas-chamadas-container"></div>
    <script type="text/javascript">
        function atualizarSenhasChamadas() {
            jQuery.ajax({
                url : '<?php echo admin_url("admin-ajax.php"); ?>',
                type : 'POST',
                data : {
                    action : 'ver_senhas_chamadas'
                },
                success : function(response) {
                    jQuery('#senhas-chamadas-container').html(response);
                }
            });
        }
        setInterval(atualizarSenhasChamadas, 1000); // Atualiza a cada segundo
        atualizarSenhasChamadas(); // Atualiza imediatamente quando a página carrega
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('ver_senhas_chamadas', 'ver_senhas_chamadas_shortcode');


function ajax_ver_senhas_chamadas() {
    global $SERVER, $USER, $SENHA, $NAMEDB;
    $conn = mysqli_connect($SERVER, $USER, $SENHA, $NAMEDB);

    if (!$conn) {
        echo "Erro na conexão com o banco de dados: " . mysqli_connect_error();
        wp_die();
    }

    $consulta = "SELECT * FROM wp_atendimentos WHERE chamado=1 AND encerrado != 1 and tipoDeAtendimento != 'Preferencial' ORDER BY wp_atendimentos.Horachamado DESC";
    $resp = mysqli_query($conn, $consulta);

    if (!$resp) {
        echo "Erro ao executar a consulta: " . mysqli_error($conn);
        wp_die();
    }

    $output = '<ul>';
    while ($dado = mysqli_fetch_assoc($resp)) {
        $output .= '<li>' . $dado["codigoAtendimento"] . ' - Guichê ' . $dado["Guinche"] . '</li>';
    }
    $output .= '</ul>';

    mysqli_close($conn);

    echo $output;
    wp_die();
}
add_action('wp_ajax_ver_senhas_chamadas', 'ajax_ver_senhas_chamadas');
add_action('wp_ajax_nopriv_ver_senhas_chamadas', 'ajax_ver_senhas_chamadas');




/**
 * Shortcode para chamar um atendimento
 */
// Conexão global ao banco de dados
global $conn;
$SERVER = "localhost";
$USER = "central";
$SENHA = "C3ntr4lf4@m@";
$NAMEDB = "central";
$conn = mysqli_connect($SERVER, $USER, $SENHA, $NAMEDB);


// Função para atualizar senha
function atualizarSenha($conn, $guiche,$usuario) {
    date_default_timezone_set('America/Sao_Paulo'); // Defina o fuso horário
    $date = date('Y-m-d H:i:s');

    $cadastro = "UPDATE `wp_atendimentos` SET chamado = '1', `Atendente` = '$usuario', `guinche` = '$guiche', `Horachamado` = '$date'
                 WHERE `wp_atendimentos`.`chamado` = 0  AND `wp_atendimentos`.`Encerrado` =  0  and tipoDeAtendimento !=  'Preferencial'  ORDER BY `wp_atendimentos`.`dataHoraAtendimento` ASC LIMIT 1";
    $envio = mysqli_query($conn, $cadastro);

    return $envio;
}
function atualizarSenhaPF($conn, $guiche,$usuario) {
    date_default_timezone_set('America/Sao_Paulo'); // Defina o fuso horário
    $date = date('Y-m-d H:i:s');

    $cadastro = "UPDATE `wp_atendimentos` SET chamado = '1', `Atendente` = '$usuario', `guinche` = '$guiche', `Horachamado` = '$date'
                 WHERE `wp_atendimentos`.`chamado` = 0  AND `wp_atendimentos`.`Encerrado` =  0  and tipoDeAtendimento =  'Preferencial'  ORDER BY `wp_atendimentos`.`dataHoraAtendimento` ASC LIMIT 1";
    $envio = mysqli_query($conn, $cadastro);

    return $envio;
}

// Função para encerrar senha anterior
function atualizarSenhaAnterior($conn, $guiche) {
    date_default_timezone_set('America/Sao_Paulo'); // Defina o fuso horário
    $date = date('Y-m-d H:i:s');

    $cadastro = "UPDATE `wp_atendimentos` SET `Encerrado` = '1', `HoraEncerramento` = '$date'
                 WHERE `wp_atendimentos`.`chamado` = 1 AND `wp_atendimentos`.`guinche` = '$guiche' and `Horachamado` != '$date' and `Encerrado` != '1'  ORDER BY `wp_atendimentos`.`dataHoraAtendimento` desc ";
    $envio = mysqli_query($conn, $cadastro);

    return $envio;
}




function chamar_atendimento_shortcode($attr) {

	$current_user = wp_get_current_user();
	   $username = $current_user->user_login;
   
	   $array = shortcode_atts(array(
		   'usuario' => $username, // Defina o usuário atual como padrão
		   'guiche' => '00'
	   ), $attr);
	   ob_start();
	   global $conn;
	   $guiche = $array['guiche'];
	   $usuario = $array['usuario'];
   
	   if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ChamarAtendimento'])) {
		   if ($conn->connect_error) {
			   die('Erro de conexão: ' . $conn->connect_error);
		   }
   
           
		   // Chama a função para atualizar a senha atual
		   if (atualizarSenha($conn, $guiche,$usuario)) {
               // Chama a função para encerrar a senha anterior
               atualizarSenhaAnterior($conn, $guiche);
			   
		   } else {
			   echo "<p>Erro ao chamar atendimento: " . $conn->error . "</p>";
		   }
   
		   $conn->close();
	   }
	   ?>
   
	   <form method="post">
		   <input type="submit" name="ChamarAtendimento" value="Chamar Atendimento">
	   </form>
	   
	   <?php
	   return ob_get_clean();
   }
   
add_shortcode('chamar_atendimento', 'chamar_atendimento_shortcode');



//chamar o atendimento mais recente so 1
function ajax_ver_senhas_chamadas_so1() {
    global $SERVER, $USER, $SENHA, $NAMEDB;
    $conn = mysqli_connect($SERVER, $USER, $SENHA, $NAMEDB);

    if (!$conn) {
        echo "Erro na conexão com o banco de dados: " . mysqli_connect_error();
        wp_die();
    }
    
    $consulta = "SELECT * FROM wp_atendimentos WHERE chamado=1 ORDER BY wp_atendimentos.Horachamado DESC LIMIT 1";
    $resp = mysqli_query($conn, $consulta);
    
    if (!$resp) {
        echo "Erro ao executar a consulta: " . mysqli_error($conn);
        wp_die();
    }

    $output = '';
    
    while ($dado = mysqli_fetch_assoc($resp)) {
        $output .= '<h1>' . $dado["codigoAtendimento"] . ' <br> Guichê ' . $dado["Guinche"] . '</h1>';
    }

    mysqli_close($conn);
    
    echo $output;
    wp_die();
}
add_action('wp_ajax_ver_senhas_chamadas_so1', 'ajax_ver_senhas_chamadas_so1');
add_action('wp_ajax_nopriv_ver_senhas_chamadas_so1', 'ajax_ver_senhas_chamadas_so1');


//chamar o atendimento mais recente so 1
function ver_senhas_chamadas_shortcodeSo1() {
    ob_start();
    ?>
    <div id="senhas_chamadas_so1"></div>
    <audio id="audio-alert" src="wp-content/themes/astra-child/audio.mp3"></audio> <!-- Substitua 'path/to/your-audio-file.mp3' pelo caminho do seu arquivo de áudio -->
    <script type="text/javascript">
        var lastContent = "";

        function atualizarSenhasChamadasSo1() {
            jQuery.ajax({
                url: '<?php echo admin_url("admin-ajax.php"); ?>',
                type: 'POST',
                data: {
                    action: 'ver_senhas_chamadas_so1'
                },
                success: function(response) {
                    if (response !== lastContent) {
                        lastContent = response;
                        jQuery('#senhas_chamadas_so1').html(response);
                        document.getElementById('audio-alert').play();
                    }
                }
            });
        }

        setInterval(atualizarSenhasChamadasSo1, 1000); // Atualiza a cada segundo
        atualizarSenhasChamadasSo1(); // Atualiza imediatamente quando a página carrega
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('ver_senhas_chamadas_so1', 'ver_senhas_chamadas_shortcodeSo1');

function exibirNovaSenha() {
    ob_start();
    
    if (isset($_SESSION['nova_senha'])) {
        echo "<p style='font-size: 24px;'>" . $_SESSION['nova_senha'] . "</p>";
        unset($_SESSION['nova_senha']); // Limpa a mensagem da sessão após exibi-la
    }

    return ob_get_clean();
}
add_shortcode('exibir_nova_senha', 'exibirNovaSenha');



function novasenhaPreferencial() {
    global $SERVER, $USER, $SENHA, $NAMEDB;
    $conn = mysqli_connect($SERVER, $USER, $SENHA, $NAMEDB);

    ob_start();
    ?>

    <form method="post">
        <input type="submit" name="gerarSenhaPreferencial" value="Preferencial">
    </form>

    <?php
    // Verifica se o botão "Gerar Nova Senha de Preferencial" foi clicado
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['gerarSenhaPreferencial'])) {
        // Verifica se há conexão com o banco de dados
        if ($conn->connect_error) {
            die('Erro de conexão: ' . $conn->connect_error);
        }

        // Gera a nova senha de Preferencial
        $codigoGerado = novasenha($conn, 'P','Preferencial'); // Chama a função e armazena o código gerado
		if ($codigoGerado) {
			$_SESSION['nova_senha'] = "Senha  gerada com sucesso: <h1> $codigoGerado</h1>"; // Armazena a mensagem na sessão
		} else {
			$_SESSION['nova_senha'] = "Erro ao gerar nova senha de Preferencial: " . $conn->error;
		}

        // Feche a conexão com o banco de dados
        $conn->close();
    }

    return ob_get_clean();
}
add_shortcode('gerar_nova_senha_Preferencial', 'novasenhaPreferencial');

function chamar_atendimentoPF_shortcode($attr) {

    $current_user = wp_get_current_user();
	   $username = $current_user->user_login;
   
	   $array = shortcode_atts(array(
           'usuario' => $username, // Defina o usuário atual como padrão
		   'guiche' => '00'
	   ), $attr);
	   ob_start();
	   global $conn;
	   $guiche = $array['guiche'];
	   $usuario = $array['usuario'];
   
	   if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ChamarAtendimentoPF'])) {
		   if ($conn->connect_error) {
			   die('Erro de conexão: ' . $conn->connect_error);
            }
   
            
            // Chama a função para atualizar a senha atual
            if (atualizarSenhaPF($conn, $guiche,$usuario)) {
               // Chama a função para encerrar a senha anterior
               atualizarSenhaAnterior($conn, $guiche);
               
		   } else {
			   echo "<p>Erro ao chamar atendimento: " . $conn->error . "</p>";
		   }
   
		   $conn->close();
	   }
	   ?>
   
   <form method="post">
		   <input type="submit" name="ChamarAtendimentoPF" value="Chamar Preferencial">
	   </form>
   
	   <?php
	   return ob_get_clean();
   }
   
   add_shortcode('chamar_atendimentoPF', 'chamar_atendimentoPF_shortcode');

   function ver_senhas_chamadasPF_shortcode() {
    ob_start();
    ?>
    <div id="senhas-chamadasPF-container"></div>
    <script type="text/javascript">
        function atualizarSenhasChamadasPF() {
            jQuery.ajax({
                url : '<?php echo admin_url("admin-ajax.php"); ?>',
                type : 'POST',
                data : {
                    action : 'ver_senhas_chamadasPF'
                },
                success : function(response) {
                    jQuery('#senhas-chamadasPF-container').html(response);
                }
            });
        }
        setInterval(atualizarSenhasChamadasPF, 1000); // Atualiza a cada segundo
        atualizarSenhasChamadasPF(); // Atualiza imediatamente quando a página carrega
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('ver_senhas_chamadasPF', 'ver_senhas_chamadasPF_shortcode');
function ajax_ver_senhas_chamadasPF() {
    global $SERVER, $USER, $SENHA, $NAMEDB;
    $conn = mysqli_connect($SERVER, $USER, $SENHA, $NAMEDB);

    if (!$conn) {
        echo "Erro na conexão com o banco de dados: " . mysqli_connect_error();
        wp_die();
    }

    $consulta = "SELECT * FROM wp_atendimentos WHERE chamado=1 AND encerrado != 1  and tipoDeAtendimento = 'Preferencial' ORDER BY wp_atendimentos.Horachamado DESC";
    $resp = mysqli_query($conn, $consulta);

    if (!$resp) {
        echo "Erro ao executar a consulta: " . mysqli_error($conn);
        wp_die();
    }

    $output = '<ul>';
    while ($dado = mysqli_fetch_assoc($resp)) {
        $output .= '<li>' . $dado["codigoAtendimento"] . ' - Guichê ' . $dado["Guinche"] . '</li>';
    }
    $output .= '</ul>';

    mysqli_close($conn);

    echo $output;
    wp_die();
}
add_action('wp_ajax_ver_senhas_chamadasPF', 'ajax_ver_senhas_chamadasPF');
add_action('wp_ajax_nopriv_ver_senhas_chamadasPF', 'ajax_ver_senhas_chamadasPF');



