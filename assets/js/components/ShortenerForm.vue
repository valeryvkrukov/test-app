<template>
  <div class="col-12 mb-2 pb-2 bg-dark">
    <div class="p-2 my-3 d-md-flex justify-content-center">
      <form class="col-sm-12 col-md-10 my-3">

          <ValidationProvider rules="url" v-slot="v" class="form-row">
            <div class="form-group col-sm-12 col-md-10">
                <input class="form-control form-control-lg" type="text" v-model="sourceLink" placeholder="Shorten your link" />
                <div id="validation-error" class="invalid-feedback">Invalid URL format</div>
            </div>
            <div class="form-group col-sm-12 col-md-2">
                <input @click="shortenLink(v)" class="btn btn-primary btn-lg w-100" type="button" value="Shorten" />
            </div>
          </ValidationProvider>
        <div v-if="shortenedLink" class="form-row">
          <ul class="shortened-link w-100">
            <li class="link">
              <span class="long-link">{{ sourceLink }}</span>
              <span>
                <span class="short-link">
                  <a :href="shortenedLink" target="_blank" title="Shortened URL">{{ shortenedLink }}</a>
                </span>
                <span class="copy">
                  <button class="btn btn-secondary" v-clipboard="shortenedLink">Copy</button>
                </span>
              </span>
            </li>
          </ul>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { createLink } from '@/services/links-service';
import isURL from 'validator/es/lib/isURL';
import { ValidationProvider, extend } from 'vee-validate';
import { clipboard } from 'vue-clipboards';

extend('url', (value) => {
  console.log(value)
  return isURL(value, {
    require_tld: true
  });
});

export default {
  name: 'ShortenerForm',
  directives: {
    clipboard
  },
  components: {
    ValidationProvider
  },
  data() {
    return {
      sourceLink: '',
      shortenedLink: null,
    };
  },
  methods: {
    shortenLink(v) {
      if (v.valid === true) {
        document.getElementById('validation-error').classList.remove('d-block');
        createLink(this.sourceLink).then((resp) => {
          this.shortenedLink = document.location.protocol + '//' + document.location.hostname + ':' + document.location.port + '/' + resp.data.shortKey;
        })
      } else {
        this.shortenedLink = null;
        document.getElementById('validation-error').classList.add('d-block');
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.shortened-link {
  list-style: none;
  margin: 0;
  padding: 0;
  margin-top: 10px;
  background-color: #fff;
  border-radius: 8px 8px 8px 8px;
  .link {
    display: flex;
    padding: 16px 20px;
    justify-content: space-between;
    align-items: center;
    position: relative;
    font-size: 18px;
    span {
      display: inline-block;
      vertical-align: middle;
      .short-link {
        padding-right: 25px;
      }
    }
  }
}
</style>