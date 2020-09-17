<template>
  <div>
    <table class="table">
      <thead>
        <th scope="col">#</th>
        <th scope="col">Source</th>
        <th scope="col">Shortened</th>
        <th scope="col">Created At</th>
      </thead>
      <tbody>
        <tr v-for="link in links">
          <th scope="row">{{ link.id }}</th>
          <td>{{ link.sourceUrl }}</td>
          <td>
            <a :href="currentHost + link.shortKey" _target="blank">{{ currentHost + link.shortKey }}</a>
          </td>
          <td>{{ createdAt(link.createdAt) }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import moment from 'moment';
import { fetchLinks } from '@/services/links-service';

export default {
  name: 'LinksPage',
  data() {
    return {
      links: []
    };
  },
  computed: {
    currentHost() {
      return document.location.protocol + '//' + document.location.hostname + ':' + document.location.port + '/';
    }
  },
  methods: {
    createdAt(createdAt) {
      return moment(createdAt).format('LLL');
    }
  },
  beforeMount() {
    fetchLinks().then((links) => {
      this.links = links.data['hydra:member'];
    })
  }
}
</script>

<style scoped>

</style>