<template lang="pug">
.container-all.body
    .fader.e-wvw.e-hvh.e-black.e-fixed
    .novidade(v-if="novidade").e-flex-col.e-
      .novidade-item.e-85(:key="novidade.slug")
        h1 {{novidade.titulo}}
        img(:src!="novidade.acf.cover").e-img-fit
        h1 {{novidade.acf.conteudo}}
        // repeater field
        .box-galeria.e-flex-col.e-wp(v-for="img in novidade.acf.galeria_rpt")
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
      axios.get(`http://nicolebahls.com.br/wp/wp-json/bahls/v1/novidade/${novidade}`).then((response) => {
        this.novidade = response.data;
        window.document.title = this.novidade.titulo + " 🔸 | EFETIVOS  "
        TweenMax.to('.fader',5,{autoAlpha:0})
      })
    }
  },
  created() {
    this.puxarnovidade(this.$route.params.slug);
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
