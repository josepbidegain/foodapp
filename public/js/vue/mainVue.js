Vue.filter('alreves', (valor) => valor.split('').reverse().join('') );

//si tengo codigo usando vue-resource y quiero trasladar a axios sin tocar las llamadas..
// piso aca para que use axios.
Vue.prototype.$http = axios;


Vue.component( 'mis-tareas',{
	props: ['tareas'],
	template: '<ul><li v-for="tarea in tareas">{{tarea.title}}</li></ul>'
})

var app3 = new Vue({
	el: "main",
	mounted(){
		axios.get('https://jsonplaceholder.typicode.com/todos')
			.then( (response) => this.tareasAjax = response.data );
	},
	data: {
		tareasAjax: [],
		tareasLocales: [
			{title:"Hacer compras"},
			{title:"Limpiar"},
			{title:"Dormir"},
		]
	}
});

var app2 = new Vue({
	el: "#container2",
	data: {
		users : []
	},
	mounted(){
		this.cargarPersonas();		
	},
	methods:{
		cargarPersonas(){
			/*this.$http.get('https://randomuser.me/api/?results=5')
			.then((response) => { this.users = response.body.results } );
			}*/

			axios.get('https://randomuser.me/api/?results=5')
				.then( (response) =>  {
						console.log(response);
						this.users = response.data.results;
					});
		}
	}
});

var app = new Vue({
	el:"#container",
	data: {
		mostrar: true,
		animate: true,
		other: true,
		busqueda:'',
		minimo: 5,
		nuevaTarea:null,
		laborales:["lunes","martes","miercoles","jueves","viernes"],
		mensaje: "Hola Mundo",
		mensajes:[
			{id:1, title:"mensaje 1"},
			{id:2, title:"mensaje 2"},
		],
		conectado: true,
		edad : 44,
		tareas: [
				{nombre:"Limpiar la casa", prioridad:"baja",completado:false},
				{nombre:"Hacer las compras", prioridad:"alta",completado:false},
				{nombre:"Ir al gimnasio", prioridad:"alta",completado:false},
				{nombre:"Descansar", prioridad:"alta",completado:false},
			],
		items: [
			{name:"item 1",prioridad:true, antiguedad:123},
			{name:"item 2",prioridad:false, antiguedad:12},
			{name:"item 3",prioridad:true, antiguedad:77},
		],
		persona: {
				nombre:"Jose", 
				edad:31, 
				sexo: "M"
		},
		juegos: [
			{titulo:"Resident Evil 7" ,genero:"Survival Horror" ,puntuacion:7},
			{titulo:"Civilization 6" ,genero:"Estrategia" ,puntuacion:10},
			{titulo:"Battlefield 1" ,genero:"FPS" ,puntuacion:1},
			
		]
	},
	beforeUpdate() {
		console.log("before update: ", this.mensaje)
	},
	updated() {
		console.log("updated: ", this.mensaje)
	},
	mounted(){
		console.log("document ready")
	},

	methods: {
		reverse(){
			this.mensaje = this.mensaje.split('').reverse().join('');
		},
		agregarTarea(){
			this.tareas.unshift({nombre:this.nuevaTarea});
			this.nuevaTarea = null;
		},
		completarTarea(tarea){
			console.log(tarea);
			tarea.completado = !tarea.completado;
		}

	},
	
	computed: {
		mensajeAlReves(){
			return this.mensaje.split('').reverse().join('');
		},
		itemsConPrioridad(){
			return this.items.filter( (item) => item.prioridad)
		},
		itemsPorAntiguedad(){
			return this.items.sort( (a,b) => b.antiguedad - a.antiguedad )
		},
		mejoresJuegos(){
			return this.juegos.filter( (juego) => juego.puntuacion >= this.minimo )
		},
		buscarJuego(){
			return this.juegos.filter( (juego) => juego.titulo.includes(this.busqueda) )
		},
		tareasCompletadas(){
			return this.tareas.filter( (tarea) => tarea.completado )
		}


	}

})