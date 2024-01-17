<script setup>
import { ref, onMounted } from "vue";
import PhotosRepository from "../repository/photos.js";

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

onMounted(init);

defineExpose({ init });
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
    display: flex; /* フレックスボックスを使用 */
    flex-wrap: wrap; /* 複数行にまたがって配置 */
    justify-content: flex-start; /* アイテムを左側に寄せる */
    align-items: center; /* アイテムを垂直方向に中央揃え */
    gap: 1rem; /* 画像間の隙間 */
}

.grid {
    width: 100%; /* グリッドの幅を100%に */
    height: auto; /* 高さを自動調整 */
    max-width: 10rem; /* 最大幅を10remに設定 */
    max-height: 10rem; /* 最大高さを10remに設定 */
    overflow: hidden; /* はみ出た部分を非表示 */
}

.grid img {
    width: 100%; /* 画像の幅をコンテナに合わせる */
    height: auto; /* 高さを自動調整 */
    object-fit: cover; /* 画像をコンテナにフィットさせる */
}
</style>
