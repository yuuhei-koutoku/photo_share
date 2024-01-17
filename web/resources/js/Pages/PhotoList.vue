<script setup>
import { ref } from "vue";
import PhotosRepository from "./../repository/photos.js";

const urls = ref([]);

const getPhoto = async () => {
    await PhotosRepository.getPhoto()
        .then((data) => {
            urls.value = data;
        })
        .catch((error) => {
            alert("写真の取得に失敗しました。");
            console.log(error);
        });
};

const init = () => {
    getPhoto();
};

init();
</script>

<template>
    <div class="photo-list">
        <div class="grid" v-for="url in urls" :key="url">
            <img :src="url.url" alt="" />
        </div>
    </div>
</template>

<style scoped>
.photo-list {
    display: flex;
}
.grid {
    width: 10rem;
    height: 10rem;
    margin: 1rem;
}
</style>
