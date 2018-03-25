<?php

	/**
	 * Classe com métodos estáticos para conversão de dados
	 */
	 class Conversor{
	 	
	 	/**
	 	 * Função para converter a data de usuário para data de banco de dados
	 	 * Converte data dia/mes/ano em ano-mes-dia
	 	 * @param $data no formato dd/mm/aaaa
	 	 * @return string com data no formato aaaa-mm-dd
	 	 */
	 	public static function dataUsuarioParaBanco($data){
	 		
	 		$vetorData = explode("/", $data);
	 		$vetorDataInvertido = array_reverse($vetorData);
	 		$dataBanco = implode("-", $vetorDataInvertido);
	 		
	 		return $dataBanco;
	 			
	 	}
	 	
	 	
	 	/**
	 	 * Função para converter a data de banco de dados para data de usuário
	 	 * Converte data ano-mes-dia em dia/mes/ano
	 	 * @param $data no formato aaaa-mm-dd
	 	 * @return string com data no formato dd/mm/aaaa
	 	 */
	 	public static function dataBancoParaUsuario($data){
	 	
	 		$vetorData = explode("-", $data);
	 		$vetorDataInvertido = array_reverse($vetorData);
	 		$dataUsuario = implode("/", $vetorDataInvertido);
	 	
	 		return $dataUsuario;
	 			
	 	}
	 	
	 	
	 	/**
	 	 * Função para converter número real de usuário para real de banco de dados
	 	 * Converte 1.200,00 em 1200.00
	 	 * @param $numero no formato de texto
	 	 * @return real no formato de banco de dados
	 	 */
	 	public static function realUsuarioParaBanco($numero){
	 		
	 		//Substituir o separador de milhar . por nada
	 		$numero = str_replace(".", "", $numero);
	 		
	 		//Substituir o sepador de decimal , por .
	 		$numero = str_replace(",", ".", $numero);
	 		
	 		return $numero;
	 			
	 	}
	 	
	 	
	 	/**
	 	 * Função para converter número real de banco de dados para real de usuário
	 	 * Converte 1200.00 em 1.200,00 
	 	 * @param $numero real
	 	 * @return string com número no formato de usuário
	 	 */
	 	public static function realBancoParaUsuario($numero){
	 	
	 		//Formatar o número
	 		$numero = number_format($numero, 2, ",", ".");
	 		
	 		return $numero;
	 			
	 	}
	 	
	 	
	 }


?>