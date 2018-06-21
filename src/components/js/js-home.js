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
        TweenMax.to('h1',4,{x:300})
      })
    }
  },
  created() {
    this.fetchData();
  }

}//CloseExport


