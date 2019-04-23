<?php

namespace App\Http\Controllers;

class BackupSQLController extends Controller {
	public function index() {

		// Backup do banco de dados do site

		$dbhost = 'localhost'; //local aonde se encontra o banco de dados
		$dbuser = 'root'; // usuário do banco de dados
		$dbpass = '123'; // senha do usuário do banco de dados
		$dbname = 'bd_laravel'; // nome do banco de dados

// rotina que faz o backup não mexer

		$backupfile = 'Autobackup_' . date("d-m-y-H-m-s") . '.sql';
		$backupzip = $backupfile;
		$dia = date('d-m-y-H-m-s');
		//$backupzip = $backupfile . '.tar.gz';
		system("mysqldump -u $dbuser -p$dbpass -q --single-transaction $dbname > /var/www/html/Lab-System/2.6/public/bkp-sql/$backupfile");
		system("tar -czvf $backupzip $backupfile");

		
// ROTINA DE ENVIO DO EMAIL COM O ANEXO

		$to = "contato@labsystem.net.br"; //Quem vai receber o email
		$from = "contato@labsystem.net.br"; //Quem está enviando (Endereço a ser apresentado como da pessoa que está enviando)
		$subject = 'Backup do Banco de Dados Sql '. $dia; //Assunto do email
		$messagem = 'cópia do backup do banco de dados Sql'; //Mensagem a ser enviada
		//$path = "http://www.labsystem.net.br/clientes/backup/"; //Diretório onde o arquivo a ser enviado está salvo
		$path = "/var/www/html/Lab-System/2.6/public/bkp-sql/"; //Diretório onde o arquivo a ser enviado está salvo

		$filename = "$backupzip"; //Nome do arquivo anexo a ser enviado - não mexer aqui

// ---------- Não altere nada deste ponto em diante ----------

		$headers = 'From: ' . "$from\r\n" . 'Reply-To: ' . "$from\r\n";

		$file = $path . "/" . $filename;
		$file_size = filesize($file);
		$handle = fopen($file, "r");
		$content = fread($handle, $file_size);
		fclose($handle);
		$content = chunk_split(base64_encode($content));

		$separator = md5(time()); // a random hash será necessário para separar conteúdos diversos a serem enviados
		$eol = PHP_EOL; // Define o retorno de carro a ser utilizado

// main header (multipart mandatory)
		$headers = "From: < $from >" . $eol;
		$headers .= "MIME-Version: 1.0" . $eol;
		$headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol . $eol;
		$headers .= "Content-Transfer-Encoding: 7bit" . $eol;
		$headers .= "This is a MIME encoded message." . $eol . $eol;

// messagem
		$headers .= "--" . $separator . $eol;
		$headers .= "Content-Type: text/plain; charset=\"utf-8\"" . $eol;
		$headers .= "Content-Transfer-Encoding: 8bit" . $eol . $eol;
		$headers .= $messagem . $eol . $eol;

// attachment
		$headers .= "--" . $separator . $eol;
		$headers .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
		$headers .= "Content-Transfer-Encoding: base64" . $eol;
		$headers .= "Content-Disposition: attachment" . $eol . $eol;
		$headers .= $content . $eol . $eol;
		$headers .= "--" . $separator . "--";
		$envio = mail($to, $subject, $headers);

//SEND Mail

		if ($envio) {
			dd("Sucesso no envio do Email");
		} else {
			dd("Erro! Não foi possível enviar o email solicitado");
		}

// Remover o arquivo do servidor (opcional)
		unlink($backupzip);
		unlink($backupfile);

	}

}
