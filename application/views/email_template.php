<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Demystifying Email Design</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>
  <!--
  <style>
  button.css3button {
  	font-family: Arial, Helvetica, sans-serif;
  	font-size: 27px;
  	color: #ffffff;
  	padding: 10px 20px;
  	background: -moz-linear-gradient(
  		top,
  		#4aa1ff 0%,
  		#4aa1ff);
  	background: -webkit-gradient(
  		linear, left top, left bottom,
  		from(#4aa1ff),
  		to(#4aa1ff));
  	-moz-border-radius: 3px;
  	-webkit-border-radius: 3px;
  	border-radius: 3px;
  	border: 0px solid #ffffff;
  	-moz-box-shadow:
  		0px 1px 3px rgba(000,000,000,0),
  		inset 0px 0px 1px rgba(255,255,255,0.6);
  	-webkit-box-shadow:
  		0px 1px 3px rgba(000,000,000,0),
  		inset 0px 0px 1px rgba(255,255,255,0.6);
  	box-shadow:
  		0px 1px 3px rgba(000,000,000,0),
  		inset 0px 0px 1px rgba(255,255,255,0.6);
  	text-shadow:
  		0px -1px 0px rgba(255,255,255,0),
  		0px 1px 0px rgba(255,255,255,0.2);
  }
-->
  <style>
      .btn {
      position: relative;

      display: block;
      margin: 30px auto;
      padding: 0;

      overflow: hidden;

      border-width: 0;
      outline: none;
      border-radius: 2px;
      box-shadow: 0 1px 4px rgba(0, 0, 0, .6);

      background-color: #2ecc71;
      color: #ecf0f1;

      transition: background-color .3s;
    }

    .btn:hover, .btn:focus {
      background-color: #27ae60;
    }

    .btn > * {
      position: relative;
    }

    .btn span {
      display: block;
      padding: 12px 24px;
    }

    .btn:before {
      content: "";

      position: absolute;
      top: 50%;
      left: 50%;

      display: block;
      width: 0;
      padding-top: 0;

      border-radius: 100%;

      background-color: rgba(236, 240, 241, .3);

      -webkit-transform: translate(-50%, -50%);
      -moz-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      -o-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
    }

    .btn:active:before {
      width: 120%;
      padding-top: 120%;

      transition: width .2s ease-out, padding-top .2s ease-out;
    }

    /* Styles, not important */
    *, *:before, *:after {
      box-sizing: border-box;
    }

    html {
      position: relative;
      height: 100%;
    }

    h2 {
      font-weight: normal;
    }

    .btn.orange {
      background-color: #e67e22;
    }

    .btn.orange:hover, .btn.orange:focus {
      background-color: #d35400;
    }

    .btn.red {
      background-color: #e74c3c;
    }

    .btn.red:hover, .btn.red:focus {
      background-color: #c0392b;
    }
  </style>

  </style>

  <body style="margin: 0; padding: 0;">
   <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
     <td style="padding: 60px 0 30px 0;">
       <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc;">
         <tr>
           <td align="center" bgcolor="#282e3a " style="padding: 40px 0 30px 0;">
            <img src="http://clicktimes.com.br/assets/layouts/layout/img/bg-1.gif" alt="Criando Mágica de E-mail" width="300" height="230" style="display: block;" />
           </td>
         </tr>
         <tr>
           <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
             <table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
                  <b>Recuperar senha</b>
                </td>
              </tr>
              <tr>
               <td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 20px;">
                Falta pouco!
                <p>
                Clique no botão abaixo para criar uma nova senha.
               </td>
              </tr>
              <tr>
               <td>
                <div align="center">
                  <form action="<?= base_url("login/forgot_password/{$hash}") ?>" method="post">
                    <button class="btn orange" type="submit"><span>Cria nova senha</span></button>
                  </form>
                </div>
               </td>
            </tr>
           </table>
         </td>
         </tr>
         <tr>
          <td bgcolor="#d1d1d1" style="padding: 10px 0px 10px 10px; font-family: Arial, sans-serif; font-size: 16px;">
           © Copyright 2016 VERSALIUS
          </td>
         </tr>
      </table>
     </td>
    </tr>
   </table>
  </body>
</html>
