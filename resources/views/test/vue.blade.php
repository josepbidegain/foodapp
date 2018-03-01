<html>
<head>
	<meta charset="UTF-8">
	<title>test con vue2</title>
	<link rel="stylesheet" href="https://raw.githubusercontent.com/daneden/animate.css/master/animate.css">
	<style>
		li{
			cursor:pointer!important;
		}
		.completado{
			text-decoration: line-through;
		}

		.aparecer-enter{
			opacity: 0;
		}
		.aparecer-enter-active{
			transition: opacity 1s;
		}
		.aparecer-leave-to{
			opacity: 0;
		}
		.aparecer-leave-active{
			transition: opacity 1s;
		}

		.bounce-enter-active {
		  animation: bounce-in .5s;
		}
		.bounce-leave-active {
		  animation: bounce-out .5s;
		}
		@keyframes bounce-in {
		  0% {
		    transform: scale(0);
		  }
		  50% {
		    transform: scale(1.5);
		  }
		  100% {
		    transform: scale(1);
		  }
		}
		@keyframes bounce-out {
		  0% {
		    transform: scale(1);
		  }
		  50% {
		    transform: scale(1.5);
		  }
		  100% {
		    transform: scale(0);
		  }
		}
	</style>
</head>
<body>
	
	<main>
		<!-- <ul>
			<li v-for="tarea in tareasAjax" v-text="tarea.title"></li>
		</ul> -->
		<h1>Tareas ajax</h1>
		<mis-tareas :tareas="tareasAjax"></mis-tareas>
		<hr>
		<h1>Tareas locales</h1>
		<mis-tareas :tareas="tareasLocales"></mis-tareas>
		<hr>
		<pre>@{{$data}}</pre>
	</main>

	<div id="container">

		<div v-if="mostrar">
			<p>hola esto es un text</p>
			<span>otro texto</span>
		</div>
		<h2 v-else>cuando no muestro lo anterior</h2> 
		<h1>Transition</h1><br>
		<transition name="aparecer" mode="out-in"><!-- out-in|in-out primero oculta y luego muestra el otro-->
			<div key="1" v-if="mostrar">animacion con transition</div>
			<div key="2" v-else>muestro transicion entre elementos</div>
		</transition>

		<transition appear name="bounce">		
			<div v-show="animate">animacion con animate css</div><br>
		</transition>	

		<transition name="custom-classes-transition" enter-active-class="animated fadeInUpBig" leave-active-class="animated bounceOutRight">		
			<div v-show="other">animacion con animate css</div>
		</transition>		

		<button @click="mostrar=!mostrar">Transition</button>
		<button @click="animate=!animate">Animation</button>
		<button @click="other=!other">Other</button>
	<hr>
		<span>@{{ mensaje }}</span><br>
		<span>Al reves con filtro => @{{ mensaje | alreves}}</span><br>
		<span>Al reves con computed property => @{{ mensajeAlReves }}</span>
		<hr>
		<button v-on:click="reverse()">Reverse Mensaje</button>
		<hr>
		<span>mejores juegos con puntuacion mayor a minimo: @{{ minimo }}</span>
		<div v-for="juego in mejoresJuegos">
			@{{ juego.titulo }} : @{{ juego.puntuacion }} pts
		</div>
		<input type="range" min=1 max=10 v-model="minimo">
		<hr>
		<span>Buscar juego</span>
		<input type="text" v-model="busqueda">
		<div v-for="juego in buscarJuego">
			@{{ juego.titulo }}
		</div>
		<hr>
		<span>Items con prioridad</span>
		<ul>
			<li v-for="item in itemsConPrioridad">
				@{{ item.name }}
			</li>
		</ul>

		<span>Items por antiguedad</span>

		<ul>
			<li v-for="item in itemsPorAntiguedad">
				@{{ item.name }}
			</li>
		</ul>
		<hr>
		<input type="text" 
			v-model="nuevaTarea" 
			placeholder="Ingresar nueva tarea"
			v-on:keyup.enter="agregarTarea()">
		<button v-on:click="agregarTarea()"> Agregar</button>
		
		<form v-on:submit.prevent="agregarTarea()">
			<input type="text" v-model="nuevaTarea" placeholder="crear tarea desde form">
			<input type="submit" value="Agregar">
		</form>	
		<hr>
		<!-- Matriz -->
		<div v-for="dia in laborales">
			@{{ dia }}
		</div>
		<hr>
		<!-- Matriz de objetos -->
		<h2>@{{tareasCompletadas.length}} completadas</h2>
		<ul>
			<li @click="completarTarea(tarea)" :class="{completado:tarea.completado}" v-for="(tarea,index) in tareas">
				@{{index}} - @{{tarea.nombre}} <small>( @{{tarea.prioridad}} )</small>
			</li>
		</ul>
<hr>
		<!-- objeto -->
		<ul>
			<li v-for="(value,key,index) in persona">
				@{{ index }} - @{{ key }} : @{{ value }}
			</li>
		</ul>
	<hr>	
		<input type="text" v-model="mensaje">
		<h1 v-show="conectado">@{{ mensaje }}</h1>
<hr>
		<h2 v-if="edad < 18"> No puedes entra</h2>
		<h2 v-else-if="edad > 200">Eres inmortal</h2>
		<h2 v-else>Estas adentro</h2>
	<hr>	
		<ul>
			<li v-for="m in mensajes">
				@{{ m.title }}
			</li>
		</ul>
		<hr>	
		<template v-if="conectado">
			<h3> bienvenido Juan </h3>
			<ul>
				<li>
					<a href="#">Mis Datos</a>
					<a href="#">Mensajes</a>
					<a href="#">Salir</a>
				</li>
			</ul>

		</template>
		<h4 v-else> No estas conectado</h4>
<hr>
		<pre>
			@{{ $data }}
		</pre>
	</div>

<div id="container2">
	
		<img v-for="user in users" :src="user.picture.thumbnail" :alt="user.name.first" :title="user.name.first" />
	
	<pre>@{{$data}}</pre>
</div>
	<script src="https://unpkg.com/vue@2.3.3"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.3.3/vue-resource.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.2/axios.js"></script>
	<script src="/js/vue/mainVue.js"></script>

</body>
</html>