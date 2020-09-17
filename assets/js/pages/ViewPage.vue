<template>
  <div>
    <h2 v-if="linkInfo">Link info</h2>
    <ul v-if="linkInfo">
      <li>Source URL: <a :href="linkInfo.sourceUrl">{{ linkInfo.sourceUrl }}</a></li>
      <li>Shortened URL: <a :href="shortKeyWithHost(linkInfo.shortKey)">{{ shortKeyWithHost(linkInfo.shortKey) }}</a></li>
      <li>Created At: {{ formatDate(linkInfo.createdAt) }}</li>
    </ul>
    <h2 v-else>Link not found...</h2>
  </div>
</template>

<script>
import { getLinkInfo } from '@/services/links-service';
import moment from 'moment/moment';

export default {
  name: 'ViewPage',
  data() {
    return {
      linkInfo: null
    };
  },
  mounted() {
    getLinkInfo(this.$route.params.searchKey).then((resp) => {
      if (parseInt(resp.data['hydra:totalItems']) > 0) {
        this.linkInfo = resp.data['hydra:member'][0];
      }
    });
  },
  methods: {
    shortKeyWithHost(key) {
      return document.location.protocol + '//' + document.location.hostname + ':' + document.location.port + '/' + key;
    },
    formatDate(date) {
      return moment(date).format('LLL');
    }
  }
}
</script>

<style scoped>

</style>