<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <link rel="stylesheet" href="public/styles/style.css">
    <!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>-->
    <style type="text/tailwindcss">
        @theme {
            --primary-bg: #FA8843;
            --side-bg: #ffd960;
            --black-text: #000000;
            --white-text: #ffffff;
            --button-links: #e47900;
            --button-links-hover: #ffba65;
            --secound-bg: #FAF1DD;

        }
        .container {
            @apply max-w-screen-lg mx-auto bg-(--secound-bg)
        }

        header {
            @apply flex text-(--white-text) bg-(--primary-bg) p-5
        }

        h1 {
            @apply font-sans text-4xl font-bold
        }

        .header-links *{
            @apply text-xs text-(--white-text)
        }

        a {
            @apply hover:underline text-(--button-links)
        }

        .pagebody {
            @apply flex flex-wrap-reverse
        }

        aside {
            @apply bg-(--side-bg) p-5 m-2 flex-grow min-w-30;
            width: 30%;
        }

        article {
            @apply p-2 m-2 flex-auto;
            width: 60%;
        }

        .box {
            @apply p-2 flex flex-col bg-(--secound-bg) border-2 border-solid border-(--black-text) text-wrap
        }

        input {
            @apply border-2 border-solid m-2 block bg-(--white-text) p-2 w-64
        }

        .checkbox {
            @apply flex text-left items-center cursor-pointer select-none
        }

        .checkbox input {
            @apply w-auto flex-none
        }

        submit, button {
            @apply p-3 bg-(--button-links) m-4 block hover:bg-(--button-links-hover) active:bg-(--button-links) w-fit
            cursor-pointer text-(--white-text)
        }

        .disabled-btn{
            @apply focus:!outline-none disabled:!opacity-25 hover:!bg-(--button-links)
        }

        p{
            @apply mt-3
        }

        @media (max-width: 768px) {
            header .header-links{
                display: none;
            }
        }

    </style>
    <title><?= $title ?></title>
