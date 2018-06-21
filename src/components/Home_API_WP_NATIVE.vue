<template lang="pug" id="post-list-template">
.container-all.body
	mymenu
		
	
	

	.search()
			h1 Filter by Name
			
			//input(type="text" name="" v-model="nameFilter")

	.display-fruits.e-wvw.e-flex
		//li(v-for="fruit in filteredFruits").e-sans {{fruit}}

	
	.ctn.e-flex
		.ctn.e-flex.e-wvh.e-hvh(v-for="post in posts")
			p {{post.id}}
			.ctn-each-post.e-flex-col
				img.aiai(v-bind:src="post.better_featured_image.source_url").e-wp.e-hp
				h1 {{post.title.rendered}}
				div(v-for="category in post.cats").e-flex.e-wp
					p {{category.name}}
				router-link( :to="{ name: 'post', params: { slug: post.id}}").t-black
					h1 LINK TO POST 

	//.modal.e-fixed.e-white.e-flex-col
		//h2 {{post[1].title.rendered}}

</template>

<script scoped type="script" src="./js/js-home.js"></script>
<style lang="scss" scoped src="./css/style-home.scss"></style>