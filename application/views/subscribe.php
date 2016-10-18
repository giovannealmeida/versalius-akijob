<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Assine</title>
	</head>
	<body>
		<h1>Assine o Premium</h1>
		<a href="<?=base_url()?>">Início</a>
		<br>
		<br>
		<table>
			<thead>
				<tr>
					<th>Assinatura Padrão</th>
					<th>Assinatura Anual</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>R$ 5,00/mês</td>
					<td>R$ 50,00/ano</td>
				</tr>
				<tr>
					<td><a href="<?=base_url("subscribe/plan/1/2")?>"><button>Assinar</button></a></td>
					<td><a href="<?=base_url("subscribe/plan/1/2")?>"><button>Assinar</button></a></td>
				</tr>

			</tbody>
		</table>
		<br>
		<br>
		
		<form action="<?=base_url("subscribe/redeem")?>" method="post">
			<label>Insira o Código: </label>
			<input type="text" name="code" id="code">
			<br>
			<input type="submit" value="Resgatar">
		</form>
	</body>
</html>
