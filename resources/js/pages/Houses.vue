<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';

import { onMounted, reactive, ref } from 'vue';

interface House {
    id: number;
    name: string;
    price: number;
    bedrooms: number;
    bathrooms: number;
    storeys: number;
    garages: number;
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Houses',
        href: '/houses',
    },
];

const filters = reactive({
    name: '',
    price_min: '',
    price_max: '',
    bedrooms: '',
    bathrooms: '',
    storeys: '',
    garages: '',
});

const houses = ref<House[]>([]);
const loading = ref(false);

const resetFilters = () => {
    Object.keys(filters).forEach(key => {
        // @ts-ignore
        filters[key] = '';
    });

    search();
};

const search = async () => {
    loading.value = true;
    try {
        const params = new URLSearchParams();

        Object.entries(filters).forEach(([key, value]) => {
            if (value !== '') {
                params.append(key, value);
            }
        });

        const response = await fetch(`/api/houses?${params.toString()}`);

        if (!response.ok) {
            throw new Error(`Ошибка запроса: ${response.status}`);
        }

        const data: House[] = await response.json();
        houses.value = data;

    } catch (e) {

        console.error('Ошибка при получении данных:', e);
        houses.value = [];

    } finally {
        loading.value = false;
    }
};

onMounted(() => {
    search();
});

</script>

<template>
    <Head title="Houses" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
                <div class="filter-container flex flex-row flex-wrap pt-10 pl-10">

                    <div class="flex flex-col space-y-1.5 pr-3">
                        <Label for="name">name</Label>
                        <Input id="name" placeholder="name" v-model="filters.name" />
                    </div>

                    <div class="flex flex-col space-y-1.5 pr-3">
                        <Label for="price_min">price_min</Label>
                        <Input id="price_min" placeholder="price_min" v-model="filters.price_min" />
                    </div>

                    <div class="flex flex-col space-y-1.5 pr-3">
                        <Label for="price_max">price_max</Label>
                        <Input id="price_max" placeholder="price_max" v-model="filters.price_max" />
                    </div>

                    <div class="flex flex-col space-y-1.5 pr-3">
                        <Label for="bedrooms">bedrooms</Label>
                        <Input id="bedrooms" placeholder="bedrooms" v-model="filters.bedrooms" />
                    </div>

                    <div class="flex flex-col space-y-1.5 pr-3">
                        <Label for="bathrooms">bathrooms</Label>
                        <Input id="bathrooms" placeholder="bathrooms" v-model="filters.bathrooms" />
                    </div>

                    <div class="flex flex-col space-y-1.5 pr-3">
                        <Label for="storeys">storeys</Label>
                        <Input id="storeys" placeholder="storeys" v-model="filters.storeys" />
                    </div>

                    <div class="flex flex-col space-y-1.5 pr-3">
                        <Label for="garages">garages</Label>
                        <Input id="garages" placeholder="garages" v-model="filters.garages" />
                    </div>

                    <div class="flex flex-col space-y-1.5 pr-3">
                        <Label>&nbsp;</Label>
                        <Button class="hover:cursor-pointer" @click="search">Search</Button>
                    </div>

                    <div class="flex flex-col space-y-1.5 pr-3">
                        <Label>&nbsp;</Label>
                        <Button class="hover:cursor-pointer" @click="resetFilters">Reset</Button>
                    </div>

                </div>

                <div class="table-container mt-10">
                    <div v-if="loading">Loading...</div>
                    <div v-else-if="houses.length === 0">Not found</div>
                    <Table>
                        <TableCaption>A list of Houses.</TableCaption>
                        <TableHeader>
                            <TableRow>
                                <TableHead>
                                    name
                                </TableHead>

                                <TableHead>
                                    price
                                </TableHead>

                                <TableHead>
                                    bedrooms
                                </TableHead>

                                <TableHead>
                                    bathrooms
                                </TableHead>

                                <TableHead>
                                    storeys
                                </TableHead>

                                <TableHead>
                                    garages
                                </TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="house in houses" :key="house.id">
                                <TableCell class="font-medium">
                                    {{ house.name }}
                                </TableCell>

                                <TableCell>
                                    {{ house.price }}
                                </TableCell>

                                <TableCell>
                                    {{ house.bedrooms }}
                                </TableCell>

                                <TableCell>
                                    {{ house.bathrooms }}
                                </TableCell>

                                <TableCell>
                                    {{ house.storeys }}
                                </TableCell>

                                <TableCell>
                                    {{ house.garages }}
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
