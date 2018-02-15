<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width">
    <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">
    <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title></title>
    <!-- The title tag shows in email notifications, like Android 4.4. -->

    <!-- Web Font / @font-face : BEGIN -->
    <!-- NOTE: If web fonts are not required, lines 9 - 26 can be safely removed. -->

    <!-- Desktop Outlook chokes on web font references and defaults to Times New Roman, so we force a safe fallback font. -->
    <!--[if mso]>
		<style>
			* {
				font-family: sans-serif !important;
			}
		</style>
	<![endif]-->

    <!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->
    <!--[if !mso]><!-->
    <!-- insert web font reference, eg: <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'> -->
    <!--<![endif]-->

    <!-- Web Font / @font-face : END -->

    <!-- CSS Reset -->
    <style>
        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */

        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }

        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        table table table {
            table-layout: auto;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        .mobile-link--footer a,
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: underline !important;
        }

        .button-link {
            text-decoration: none !important;
        }
    </style>

    <!-- Progressive Enhancements -->
    <style>

        .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }

        .button-td:hover,
        .button-a:hover {
            background: #555555 !important;
            border-color: #555555 !important;
        }
        /* Media Queries */

        @media screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
                margin: auto !important;
            }
            .fluid {
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }
            .stack-column,
            .stack-column-center {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }
            .stack-column-center {
                text-align: center !important;
            }
            .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }
            table.center-on-narrow {
                display: inline-block !important;
            }
        }
    </style>

</head>

<body bgcolor="#ffffff" width="100%" style="margin: 0;">
    <center style="width: 100%; background: #fff;">

        <!-- Visually Hidden Preheader Text : BEGIN -->
        <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;">
            Boas Notícias!
        </div>
        <!-- Visually Hidden Preheader Text : END -->


        <!-- Email Body : BEGIN -->
        <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto;" class="email-container">

            <!-- Hero Image, Flush : BEGIN -->
            <tr>
                <td bgcolor="#3e454d" style="padding: 40px 0 ;">
                    <img src="http://www.akijob.com.br/assets/img/logo-vetor.png" width="250" height="150" alt="alt_text" border="0" align="center" class="fluid" style="margin: 0 auto; height: auto; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;display:block;">
                    <h1 style="font-family: sans-serif; margin-top: 20px; margin-bottom: 0px; color: white; display:block; text-align:center;">Recuperação de senha</h1>
                </td>
            </tr>
            <!-- Hero Image, Flush : END -->

            <!-- 1 Column Text : BEGIN -->
            <tr>
                <td bgcolor="#ffffff" style="padding: 40px; text-align: center; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: black;">
                    <p>
                        Olá! Recebemos uma solicitação de recuperação de senha para este email. Para trocar sua senha, clique no botão abaixo.
                    </p>
                    <br>
                    <p>
                        Caso não tenha sido você quem solicitou este serviço, apenas desconsidere este email.
                    </p>
                    <br>
                    <!-- Button : Begin -->
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto">
                        <tr>
                            <td style="border-radius: 3px; background: #222222; text-align: center;" class="button-td">
                                <a href="<?= base_url("login/forgot_password/{$hash}") ?>" style="background: #222222; border: 15px solid #222222; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a">
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#ffffff;">Clique aqui para redefinir sua senha</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                </a>
                            </td>
                        </tr>
                    </table>
                    <!-- Button : END -->
                </td>
            </tr>
            <!-- 1 Column Text : BEGIN -->


        </table>
        <!-- Email Body : END -->

        <!-- Email Footer : BEGIN -->
        <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto;" class="email-container">
            <tr>
                <td style="padding: 40px 10px;width: 100%; font-family: sans-serif; mso-height-rule: exactly; line-height:18px; text-align: center; color: black;">
                    <webversion style="font-weight: bold;">Qualquer dúvida, entre em contato através do <span ><a href="malito(contato@versalius.com.br)" style="color:#e2563c;text-decoration:none;">contato@versalius.com.br</a></span></webversion>
                    <br>
                    <br>
                    <a href="https://www.facebook.com/VersaliusSD">
                        <img src="http://www.akijob.com.br/assets/img/facebook-icon.png" width="35" height="150" alt="alt_text" border="0" align="center" class="fluid" style="margin: 0 auto; height: auto; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;display:block;">
                    </a>

                    <br>
                    <br>
                    <unsubscribe style="color:#888888; text-decoration:none;">Akijob 2016 </unsubscribe>
                </td>
            </tr>
        </table>
        <!-- Email Footer : END -->

    </center>
</body>

</html>
