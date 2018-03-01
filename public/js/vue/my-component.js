Vue.component('elegir-ganador', {
	props: ['listado'],
	template: `<div>
					<a href="#" @click="ocultarWidget">Cerrar</a>
					<h1 v-if="ganador">El ganador es {{ganador}}</h1>
					<template v-else>
						<slot>Texto por default</slot>
						<h1>Parcicipantes</h1>
						<ul><li v-for="persona in listado">{{persona}}</li></ul>
					</template>
					<button v-on:click="elegirGanador">Elegir</button>
				</div>`,
	methods:{
		elegirGanador(){		
			this.listado = null;	
			let cantidad = this.participantes.length;
			let indice = Math.floor(Math.random() * cantidad );
			this.ganador = this.participantes[indice-1];
		},
		ocultarWidget(){

			// lanzo evento para que se escuche desd el padre, cuando defino instancia de componente, tengo un @ocultar
			this.$emit('ocultar');
		}

	},	
	data() {
		return {
			ganador: false,
			participantes: this.listado
		}
	}
});

new Vue({
	el:'main',
	data: {
		personas: ['Juan','Maria','Jose','Martin'],
		mostrar1: false,
		mostrar2: false
		
	}
})