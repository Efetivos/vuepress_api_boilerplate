#Step by Step
### Dependencies: Wordpress API, Axios

> 1) Install Wordpress <br>

> 2) Follow Archives on Wordpress Folder (on this Repo)
-  Create Custom Post (By Function.php on Theme)
-  Create Custom Fields (ACF)
-  Create API do CUSTOM POST
-  Create API do POST do CUSTOM POST
>//referencia:  https://www.youtube.com/watch?v=7QiPc-ElZwE (Webinar Origamid)


### No VueJS 
> 3) Pagina com o nome do Custom Post ex.: Novidades
- Pagina ListPost:
```bash
<template lang="pug">
.container-all.body
	mymenu
		
	.ctn.e-flex
		.ctn.e-flex.e-wvh.e-hvh(v-for="novidade in novidades") //laço para exibir postagens
			p {{novidade.id}}
			.ctn-each-novidade.e-flex-col
				img.aiai(v-bind:src="novidade.cover").e-wp.e-hp //imagem usando ACF
				h1 {{novidade.titulo}}
				p {{novidade.conteudo}}
				
				router-link( :to="{ name: 'novidade', params: { slug: novidade.slug}}").t-black //Link dinamico para cada Postagem (vue-router) + Passa o Slug para o Router
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
      novidades: [], //nome do Custom POst
    }
  },
  methods: {
    fetchData() {
      axios.get('http://nicolebahls.com.br/wp/wp-json/bahls/v1/novidades').then((resposta) => { //API do CUSTOM Post
        this.novidades = resposta.data; //retorna quando puxar dados da API
      })
    }
  },
  created() {
    this.fetchData(); //Chama a função da API quando o Compenente é criado
  }

}//CloseExport</script>
<style lang="scss" scoped src="./css/style-home.scss"></style>
```

> 4) > 4) Pagina com o nome do Post ex.: Novidade
- Pagina do Post (Single):
```bash
<template lang="pug">
.container-all.body
    .fader.e-wvw.e-hvh.e-black.e-fixed
    .novidade(v-if="novidade").e-flex-col.e- //verifica se tem o post 
      .novidade-item.e-85(:key="novidade.slug")
        h1 {{novidade.titulo}}
        img(:src!="novidade.acf.cover").e-img-fit
        h1 {{novidade.acf.conteudo}}
        // repeater field
        .box-galeria.e-flex-col.e-wp(v-for="img in novidade.acf.galeria_rpt") //cria Loop para repeater
          img(:src!="img.img_galeria").img-repeat.e-img-fit

    router-link(to="/").backhome
      span VOLTAR 

</template>

<script>
import axios from 'axios';

export default {
  name: 'novidade',
  data() {
    return {
      novidade: '',
    }
  },
  methods: {
    puxarnovidade(novidade) {
      axios.get(`http://nicolebahls.com.br/wp/wp-json/bahls/v1/novidade/${novidade}`).then((response) => { //API do POST mais Slug Passado no Componente PostList
        this.novidade = response.data;
        window.document.title = this.novidade.titulo + " 🔸 | EFETIVOS  " // Concatena o Titulo do Post com o nome do Site
        TweenMax.to('.fader',5,{autoAlpha:0})
      })
    }
  },
  created() {
    this.puxarnovidade(this.$route.params.slug); // Passo o SLug para o Axios Get
  },
  beforeRouteUpdate(to, from, next) {
    this.puxarnovidade(to.path.substring(1));
    next();
  },
  
}
</script>
<style lang="scss" scoped>
 img {
   padding: 5vh;
   height: 60vh;
   width: 60vw;
 }
.fader {
    background: #000;
    left: 0;
    top: 0;
    pointer-events: none;
}
</style>
```

> 5) Vue Router
- index.js (router)
```bash
import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/Home'
import Novidade from '@/components/Novidade' //Rota para a Pagina Single

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/:slug', //Recebe SLug na Pagina PostList
      name: 'novidade',
      component: Novidade
    },
    {
      path: '/',
      name: 'Home',
      component: Home
    },
    {
      path: '*',
      name: '404',
      component: Home
    }
  ]
})

```