<script setup lang="ts">
import { ref } from 'vue';
import { storeToRefs } from 'pinia';
import { useMainStore } from '../AppState';

import CmpToast from '../Components/CmpToast.vue';

const main = useMainStore();
const { appName, browserSuppport } = storeToRefs(main);

const toastchild = ref<typeof CmpToast>();
</script>

<template>
    <CmpToast ref="toastchild" />
    <div
        class="grid content-center w-screen h-screen bg-neutral object-fill bg-no-repeat bg-cover bg-center"
    >
        <div class="flex justify-center">
            <div v-show="!loading" class="bg-base-300 rounded-lg drop-shadow-lg">
                <div class="m-auto p-5">
                    <div class="text-center font-bold my-2.5">
                        {{ appName }}
                    </div>
                    <div v-if="!browserSuppport" class="text-center font-bold my-2.5">
                        <button class="btn btn-sm btn-error">
                            <i class="pi pi-times m-1" />
                            <span class="m-1">Browser Unsupported</span>
                        </button>
                    </div>
                    <div class="text-center font-bold my-2.5">WELCOME ! ! !</div>
                </div>
            </div>
        </div>
    </div>
</template>
