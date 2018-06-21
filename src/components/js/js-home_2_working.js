import { TweenMax } from 'gsap'
import $ from 'jquery'
import Mymenu from '../Mymenu.vue'
import axios from 'axios';



export default {
  template: '#post-list-template',
  components: {
    'mymenu': Mymenu
  },
  data() {
    return {
      posts: [],
      nameFilter: '',
      fruits: ['Apple', 'Banana', 'Mango', 'Melon']

    }
  },

  methods: {
    fetchData() {
      axios
        .get('http://dratalitarodrigues.com.br/novo/wp-json/wp/v2/posts')
        .then((resposta) => {
          this.posts = resposta.data;
        })
    },
  },
  created() {
    this.fetchData();
  }
  ,
  computed: {
    filteredFruits() {
      return this.fruits.filter((element) => {
        return element.match(this.nameFilter);
      });
    },
    filteredPosts() {
      return this.posts.filter((element) => {
        return element.match(this.nameFilter);
      });
    }
  },
  mounted() {
    console.log('mounted')
    TweenMax.to('h1', 2, { x: 300 })

  } // mounted

}//CloseExport


