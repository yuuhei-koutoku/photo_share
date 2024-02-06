<script setup>
import { ref } from "vue";
import PhotosRepository from "../repository/photos.js";

const fileInput = ref(null);

const emit = defineEmits(["photo-uploaded"]);

const onClickAddImage = () => {
    postPhoto(fileInput.value.files[0]);
};

const postPhoto = async (file) => {
    await PhotosRepository.postPhoto(file)
        .then((data) => {
            console.log(data);
            alert("写真の投稿が完了しました");
            emit("photo-uploaded");
        })
        .catch((error) => {
            if (error.response && error.response.status === 401) {
                alert("ログインしてください。");
            } else {
                alert("写真の投稿に失敗しました。");
            }
            console.log(error);
        })
        .finally(() => {
            fileInput.value.value = "";
        });
};
</script>

<template>
    <div class="photo-form">
        <form enctype="multipart/form-data">
            <input class="select-file" type="file" ref="fileInput" />
            <div>
                <button
                    type="submit"
                    class="button-submit"
                    @click.prevent="onClickAddImage"
                >
                    送信
                </button>
            </div>
        </form>
    </div>
</template>

<style scoped>
.photo-form {
    max-width: 540px; /* 最大幅を540pxに設定 */
    margin: 0 auto; /* 上下のマージンを0に、左右のマージンを自動調整して中央寄せ */
    margin-top: 12px;
    padding: 0 24px; /* 左右のパディングを24pxに設定 */
}

.select-file {
    margin: 5px 0; /* マージン */
}

.button-submit {
    background-color: #007bff; /* 青色の背景 */
    color: white; /* 文字は白色 */
    padding: 5px 10px; /* パディング */
    margin: 5px 0; /* マージン */
    border: none; /* 境界線なし */
    border-radius: 5px; /* 角丸のデザイン */
    cursor: pointer; /* カーソルをポインタに */
    font-size: 16px; /* フォントサイズ */
    transition: background-color 0.3s; /* 背景色の変化を滑らかに */
}

.button-submit:hover {
    background-color: #0056b3; /* マウスオーバー時の背景色 */
}
</style>
