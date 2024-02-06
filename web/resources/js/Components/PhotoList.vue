<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import PhotosRepository from "../repository/photos.js";

const photos = ref([]);

const getPhoto = async () => {
    await PhotosRepository.getPhoto()
        .then((data) => {
            photos.value = data;
        })
        .catch((error) => {
            alert("写真の取得に失敗しました。");
            console.log(error);
        })
        .finally(() => {});
};

const init = () => {
    getPhoto();
};

init();

defineExpose({ init });
</script>

<template>
    <div class="photo-list">
        <div class="grid" v-for="(photo, index) in photos" :key="index">
            <Link :href="`/photos/${photo.id}`">
                <img :src="photo.url" alt="" />
            </Link>
        </div>
    </div>
</template>

<style scoped>
.photo-list {
    display: flex; /* フレックスボックスを使用 */
    flex-wrap: wrap; /* 複数行にまたがって配置 */
    justify-content: flex-start; /* アイテムを左側に寄せる */
    align-items: center; /* アイテムを垂直方向に中央揃え */
    row-gap: 1rem; /* 上下方向の隙間を設定 */
    max-width: 540px; /* 最大幅を540pxに設定 */
    margin: 0 auto; /* 上下のマージンを0に、左右のマージンを自動調整して中央寄せ */
    padding: 0 24px; /* 左右のパディングを24pxに設定 */
}

.grid {
    width: calc(33.333% - 1rem); /* gapを考慮した幅の設定 */
    margin: 0 0.5rem; /* 各.grid要素の左右に等しいマージンを追加 */
    height: auto; /* 高さを自動調整 */
    overflow: hidden; /* はみ出た部分を非表示 */
}

.grid img {
    width: 100%; /* 画像の幅をコンテナに合わせる */
    height: auto; /* 高さを自動調整 */
    object-fit: cover; /* 画像をコンテナにフィットさせる */
    border-radius: 0.375rem; /* ボーダーの丸み */
}
</style>
