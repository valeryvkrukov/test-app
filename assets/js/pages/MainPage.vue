<template>
  <div>
    <jumbotron />
    <shortener-form />
  </div>
</template>

<script>
import Jumbotron from '@/components/Jumbotron';
import ShortenerForm from '@/components/ShortenerForm';

export default {
  name: 'MainPage',
  components: {
    Jumbotron,
    ShortenerForm
  }
}
</script>

<style scoped>

</style>