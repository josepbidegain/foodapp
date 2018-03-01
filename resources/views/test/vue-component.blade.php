<html>
<head>
	<meta charset="UTF-8">
	<title>Vue components</title>
</head>
<body>
	
	<main>
		<button @click="mostrar1=true">Mostrar1</button>
		<button @click="mostrar2=true">Mostrar2</button>

		<elegir-ganador v-show="mostrar1" @ocultar="mostrar1=false" :listado="personas">
			Cambiando el texto..
		</elegir-ganador>

		<elegir-ganador v-show="mostrar2" @ocultar="mostrar2=false" :listado="personas">
			Cambiando el texto 2..
		</elegir-ganador>

		@{{ $data }}
	</main>
	<script src="https://unpkg.com/vue@2.3.3"></script>
	<script src="/js/vue/my-component.js"></script>
</body>
</html>