<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h1>Hello {{$order->client->name}},</h1>

<p>Tu pedido fue aceptado, en breve te llegara sms confirmando</p>

	<p>{ID: {$order->restaurant->id}}</p>
	<p>Restaurant: {{$order->restaurant->name}}</p>
	
	


</body>
</html>