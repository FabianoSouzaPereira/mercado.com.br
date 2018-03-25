function addControl(o){
	o.setAttribute('controls','');
}

function removControl(o){
	o.removeAttribute('controls');
}


function finalizarVenda(){ //Quando clicado no elemento input
		
			$.ajax({
		        url: 'ajax/finalizarVenda.php',
		        method: "GET",
		        data: { 
			        	
			        },
		        
		        success: function(data) {
		        	if(data!=-1){
		        		if(data=='sucesso'){
		        			alertSucesso("Parabéns", "Cursos adiquiridos com sucesso!");
		        		}else{
		        			alertSucesso2("Parabéns", "Cursos adiquiridos com sucesso!<br />Você precisa realizar o pagamento para acesar os cursos não gratuitos!");
		        			window.open(
		        					"../aluno/pagar.php?vendaId="+data,
		        					  '_blank' // <- This is what makes it open in a new window.
		        					);
		        		
		        			
		        		}
		        		
		        		atualizarCarrinho();
		        		atualizaContagemItens();
		        	} else {
		        		alertErro("Erro", "Sua compra não foi finalizada!");
		        	}
		        }
		        
		  });
			  
	}




function addCurso(id){ //Quando clicado no elemento input
		
			$.ajax({
		        url: 'ajax/addCursoCarrinho.php',
		        method: "GET",
		        data: { 
			        	id_curso: id
			        },
		        
		        success: function(data) {
			        var totalProdutos = parseFloat($(".total_cursos").html()) + 1;
		         	$(".total_cursos").html(totalProdutos);
		         	$("#carrinho_compras").append(data);
		         	atualizarValorTotal();
		         	alertSucesso("Sucesso", "Curso adicionado à lista");
		         	
		        }
		        
		  });
			  
	}



	function atualizarCarrinho(){ //Quando clicado no elemento input
		$("#carrinho_compras").html("<tr><td colspan='4'>Carregando...</td></tr>");
		$.ajax({
	        url: 'ajax/atualizarCarrinho.php',
	        method: "GET",
	        data: { 
		        	
		        },
	        
	        success: function(data) {
		        
	         	$("#carrinho_compras").html(data);
	        }
	        
	  });  
	}


	function atualizaContagemItens(){

		$.ajax({
	        url: 'ajax/atualizaContagemItens.php',
	        method: "GET",
	        data: { 
		        	
		        },
	        
	        success: function(data) {
	         	$(".total_cursos").html(data);
	        }
	        
	  });

	}



	function removerLinha(i){

		$.ajax({
	        url: 'ajax/removerCursoCarrinho.php',
	        method: "GET",
	        data: { 
		        	i: i
		        },
	        
	        success: function(data) {
		        
	         	$("#linha-"+i).fadeOut(500);
		        var totalProdutos = parseFloat($(".total_cursos").html()) - 1;
	         	$(".total_cursos").html(totalProdutos);
	         	atualizarValorTotal();
	        }
	        
	  });

	}


	function atualizarValorTotal(){

		$.ajax({
	        url: 'ajax/atualizarValorTotal.php',
	        method: "GET",
	        data: { 
		        	
		        },
	        
	        success: function(data) {
		        
	         	$(".valor_total").html(data);
	        }
	        
	  });
		
	}
	
	
	
	function login3(email, senha){
		
		if(email==""){
			alert("E-mail é um campo obrigatório");
			$("#emailLogin").css("border-color", "#F0507B");
			$("#emailLogin").focus();
			return false;
		}
		
		if(senha==""){
			alert("Senha é um campo obrigatório");
			$("#senhaLogin").css("border-color", "#F0507B");
			$("#senhaLogin").focus();
			return false;
		}
		

		$("#painel-login-aluno").html("Efetuando o acesso...");
		$.ajax({
	        url: 'ajax/loginAluno.php',
	        method: "GET",
	        data: { 
		        	email: email,
		        	senha: senha
		        },
	        
	        success: function(data) {
	        	if(data!=0){
	        		$("#painel-login-aluno").html(data);
	        		$("#controle-finalizar-carrinho").html('<button type="button" onclick="finalizarVenda()" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-flag"> </span> Finalizar Compra</button>');
					
	        		document.getElementById("link-user").setAttribute("onclick", "window.location='../aluno/'");
	        		document.getElementById("link-user").removeAttribute("data-toggle");
	        		document.getElementById("link-user").removeAttribute("data-target");
	        		document.getElementById("link-user").setAttribute("title", "Clique aqui para acessar seu perfil de aluno");
					//window.location = "../aluno/";
	        		 if( parseFloat($(".total_cursos").html())>0 )
	        			 finalizarVenda();
				} else {
	        		alertErro("", "Falha ao realizar acesso!");
	        		logout();
	        	}
	        }
	        
	  });
		
	}
	
	
	
	function login(){
		
		var email = $("#emailLogin").val();
		var senha = $("#senhaLogin").val();
		
		if(email==""){
			alert("E-mail é um campo obrigatório");
			$("#emailLogin").css("border-color", "#F0507B");
			$("#emailLogin").focus();
			return false;
		}
		
		if(senha==""){
			alert("Senha é um campo obrigatório");
			$("#senhaLogin").css("border-color", "#F0507B");
			$("#senhaLogin").focus();
			return false;
		}
		

		$("#painel-login-aluno").html("Efetuando o acesso...");
		$.ajax({
	        url: 'ajax/loginAluno.php',
	        method: "GET",
	        data: { 
		        	email: email,
		        	senha: senha
		        },
	        
	        success: function(data) {
	        	if(data!=0){
	        		$("#painel-login-aluno").html(data);
	        		$("#controle-finalizar-carrinho").html('<button type="button" onclick="finalizarVenda()" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-flag"> </span> Finalizar Compra</button>');
					
	        		document.getElementById("link-user").setAttribute("onclick", "window.location='../aluno/'");
	        		document.getElementById("link-user").removeAttribute("data-toggle");
	        		document.getElementById("link-user").removeAttribute("data-target");
	        		document.getElementById("link-user").setAttribute("title", "Clique aqui para acessar seu perfil de aluno");
					//window.location = "../aluno/";
				} else {
	        		alertErro("", "Falha ao realizar acesso!");
	        		logout();
	        	}
	        }
	        
	  });
		
	}
	
	
	
	
	
	
	function login2(){
		
		var email = $("#emailLogin2").val();
		var senha = $("#senhaLogin2").val();
		
		if(email==""){
			alert("E-mail é um campo obrigatório");
			$("#emailLogin2").css("border-color", "#F0507B");
			$("#emailLogin2").focus();
			return false;
		}
		
		if(senha==""){
			alert("Senha é um campo obrigatório");
			$("#senhaLogin2").css("border-color", "#F0507B");
			$("#senhaLogin2").focus();
			return false;
		}
		

		$("#painel-login-aluno").html("Efetuando o acesso...");
		$.ajax({
	        url: 'ajax/loginAluno.php',
	        method: "GET",
	        data: { 
		        	email: email,
		        	senha: senha
		        },
	        
	        success: function(data) {
	        	if(data!=0){
	        		$("#painel-login-aluno").html(data);
	        		$("#controle-finalizar-carrinho").html('<button type="button" onclick="finalizarVenda()" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-flag"> </span> Finalizar Compra</button>');
	        		document.getElementById("link-user").setAttribute("onclick", "window.location='../aluno/'");
	        		document.getElementById("link-user").removeAttribute("data-toggle");
	        		document.getElementById("link-user").removeAttribute("data-target");
	        		document.getElementById("link-user").setAttribute("title", "Clique aqui para acessar seu perfil de aluno");
	        		//window.location = "../aluno/";
				} else {
	        		alertErro("", "Falha ao realizar acesso!");
	        		logout();
	        	}
	        }
	        
	  });
		
	}
	
	
	
	
	
	function logout(){
		
		$.ajax({
	        url: 'ajax/logoutAluno.php',
	        method: "GET",
	        data: { 
		        },
	        
	        success: function(data) {
	        		//alertSucesso("", "Deslogado com sucesso");
	        		$("#painel-login-aluno").html(data);
	        		$("#controle-finalizar-carrinho").html('<p>Para finalizar,</p><button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#modal-login" ><span class="glyphicon glyphicon-asterisk"> </span> Faça o Login</button><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal" data-dismiss="modal" ><span class="glyphicon glyphicon-user"> </span> Cadastre-se</button>');
	        		document.getElementById("link-user").removeAttribute("onclick", "window.location='../aluno/'");
	        		document.getElementById("link-user").setAttribute("data-toggle", "modal");
	        		document.getElementById("link-user").setAttribute("data-target", "#modal-login");
	        		document.getElementById("link-user").setAttribute("title", "Clique aqui para realizar o acesso");
	        }
	        
	  });
		
	}
	
	function validacao(nome, telefone, email, senha, senha2){
		
		if(senha!=senha2){
			alert("As senhas não conferem.");
			$("#senha").val("");
			$("#senha2").val("");
			$("#senha").focus();
			$("#senha").css("border-color", "#F0507B");
			return false;
		}
		
		if(nome==""){
			alert("Nome é um campo obrigatório");
			$("#nome").css("border-color", "#F0507B");
			$("#nome").focus();
			return false;
		}
		
				
		if(email==""){
			alert("E-mail é um campo obrigatório");
			$("#email").css("border-color", "#F0507B");
			$("#email").focus();
			return false;
		}
		
		if(senha==""){
			alert("Senha é um campo obrigatório");
			$("#senha").css("border-color", "#F0507B");
			$("#senha").focus();
			return false;
		}
	}
	
	
	function cadastroAluno(){ //Quando clicado no elemento input
		
		var nome = $("#nome").val();
		var telefone = $("#telefone").val();
		var email = $("#email").val();
		var senha = $("#senha").val();
		var senha2 = $("#senha2").val();
		
		validacao(nome, telefone, email, senha, senha2);
		
		$.ajax({
	        url: 'ajax/cadastrarAluno.php',
	        method: "GET",
	        data: { 
		        	nome: nome,
		        	telefone: telefone,
		        	email: email,
		        	senha: senha
		        },
	        
	        success: function(data) {
	        	
		        if(data==1){
		        	alertSucesso("", "Cadastro efetuado com sucesso!  Agora você já pode efetuar o acesso.");
		        	
		        	$("#nomeInicio").val("");
		        	$("#emailInicio").val("");
		        	$("#nome").val("");
		    		$("#telefone").val("");
		    		$("#email").val("");
		    		$("#senha").val("");
		    		$("#senha2").val("");
		    		
		        }
		        	
	        }
	        
	  });
		  
	}
	
	
	function cadastroAluno2(){ //Quando clicado no elemento input
		
		var nome = $("#nome").val();
		var telefone = $("#telefone").val();
		var email = $("#email").val();
		var senha = $("#senha").val();
		var senha2 = $("#senha2").val();
		
		validacao(nome, telefone, email, senha, senha2);
		
		$.ajax({
	        url: 'ajax/cadastrarAluno.php',
	        method: "GET",
	        data: { 
		        	nome: nome,
		        	telefone: telefone,
		        	email: email,
		        	senha: senha
		        },
	        
	        success: function(data) {
	        	
		        if(data==1){
		        	alertSucesso2("", "Cadastro efetuado com sucesso!  Seu acesso já foi realizado.");
		        	
		        	$("#nomeInicio").val("");
		        	$("#emailInicio").val("");
		        	$("#nome").val("");
		    		$("#telefone").val("");
		    		$("#email").val("");
		    		$("#senha").val("");
		    		$("#senha2").val("");
		    		login3(email, senha);
		    		
		        }
		        	
	        }
	        
	  });
		  
	}
	
	
function montaAlerts(titulo, texto){
	$(".titulo-alert").html(titulo);
	$(".label-alert").html(texto);
}
	
function alertSucesso(titulo, texto){
	montaAlerts(titulo, texto);
	$("#alerta-sucesso").fadeIn(500).delay(2500).fadeOut(2000);
}

function alertSucesso2(titulo, texto){
	montaAlerts(titulo, texto);
	$("#alerta-sucesso").fadeIn(500).delay(3500).fadeOut(2000);
}


function alertErro(titulo, texto){
	montaAlerts(titulo, texto);
	$("#alerta-erro").fadeIn(500).delay(2500).fadeOut(2000);
}





















/**
 * jquery.wait - insert simple delays into your jquery method chains
 * @author Matthew Lee matt@madleedesign.com
 */

(function ($) {
    function jQueryDummy ($real, delay, _fncQueue) {
        // A Fake jQuery-like object that allows us to resolve the entire jQuery
        // method chain, pause, and resume execution later.

        var dummy = this;
        this._fncQueue = (typeof _fncQueue === 'undefined') ? [] : _fncQueue;
        this._delayCompleted = false;
        this._$real = $real;

        if (typeof delay === 'number' && delay >= 0 && delay < Infinity)
            this.timeoutKey = window.setTimeout(function () {
                dummy._performDummyQueueActions();
            }, delay);

        else if (delay !== null && typeof delay === 'object' && typeof delay.promise === 'function')
            delay.then(function () {
                dummy._performDummyQueueActions();
            });

        else if (typeof delay === 'string')
            $real.one(delay, function () {
                dummy._performDummyQueueActions();
            });

        else
            return $real;
    }

    jQueryDummy.prototype._addToQueue = function(fnc, arg){
        // When dummy functions are called, the name of the function and
        // arguments are put into a queue to execute later

        this._fncQueue.unshift({ fnc: fnc, arg: arg });

        if (this._delayCompleted)
            return this._performDummyQueueActions();
        else
            return this;
    };

    jQueryDummy.prototype._performDummyQueueActions = function(){
        // Start executing queued actions.  If another `wait` is encountered,
        // pass the remaining stack to a new jQueryDummy

        this._delayCompleted = true;

        var next;
        while (this._fncQueue.length > 0) {
            next = this._fncQueue.pop();

            if (next.fnc === 'wait') {
                next.arg.push(this._fncQueue);
                return this._$real = this._$real[next.fnc].apply(this._$real, next.arg);
            }

            this._$real = this._$real[next.fnc].apply(this._$real, next.arg);
        }

        return this;
    };

    $.fn.wait = function(delay, _queue) {
        // Creates dummy object that dequeues after a times delay OR promise

        return new jQueryDummy(this, delay, _queue);
    };

    for (var fnc in $.fn) {
        // Add shadow methods for all jQuery methods in existence.  Will not
        // shadow methods added to jQuery _after_ this!
        // skip non-function properties or properties of Object.prototype

        if (typeof $.fn[fnc] !== 'function' || !$.fn.hasOwnProperty(fnc))
            continue;

        jQueryDummy.prototype[fnc] = (function (fnc) {
            return function(){
                var arg = Array.prototype.slice.call(arguments);
                return this._addToQueue(fnc, arg);
            };
        })(fnc);
    }
})(jQuery);

