<template lang="pug">
.container-all.body
	mymenu
		
	.ctn.e-flex
		.ctn.e-flex.e-wvh.e-hvh(v-for="novidade in novidades")
			p {{novidade.id}}
			.ctn-each-novidade.e-flex-col
				img.aiai(v-bind:src="novidade.cover").e-wp.e-hp
				h1 {{novidade.titulo}}
				p {{novidade.conteudo}}
				
				router-link( :to="{ name: 'novidade', params: { slug: novidade.slug}}").t-black
					h1 LINK TO novidade 


</template>

<script>
import { TweenMax } from 'gsap'
import $ from 'jquery'
import axios from 'axios';

export default {
  name: 'novidades',
  data() {
    return {
      novidades: [],
    }
  },
  methods: {
    fetchData() {
      axios.get('http://nicolebahls.com.br/wp/wp-json/bahls/v1/novidades').then((resposta) => {
        this.novidades = resposta.data;
      })
    }
  },
  created() {
    this.fetchData();
  }

}//CloseExport</script>
<style lang="scss" scoped src="./css/style-home.scss"></style>