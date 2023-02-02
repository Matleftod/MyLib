<template>
    <div>
    <stripe-checkout
      ref="checkoutRef"
      mode="payment"
      :pk="publishableKey"
      :line-items="lineItems"
      :success-url="successURL"
      :cancel-url="cancelURL"
      @loading="v => loading = v"
    />
    <button @click="submit" class="stripe-button">
      Get Premium !
      <div class="mask"></div>
    </button>
  </div>
</template>

<script lang="ts">
import { StripeCheckout } from '@vue-stripe/vue-stripe';

export default {
  name: 'Stripe',
  components: {
    StripeCheckout,
  },
  data () {
    this.publishableKey = 'pk_test_51MWy46Jv9xCelsB6yhoSeLWVtaU0S04zHLGLESTHblIycB5XvMwgiteGgGiNPrVfDZdck4FcLsN8Dmji35e9xCaK00rwBdSk42'
    return {
      loading: false,
      lineItems: [
        {
          price: 'price_1MWyPJJv9xCelsB6cK2TuBIi', // The id of the one-time price you created in your Stripe dashboard
          quantity: 1,
        },
      ],
      successURL: 'http://127.0.0.1:8000/account',
      cancelURL: 'http://127.0.0.1:8000/account',
    };
  },
  methods: {
    submit () {
      // You will be redirected to Stripe's secure checkout page
      this.$refs.checkoutRef.redirectToCheckout();
    },
  },
}
</script>

<style scoped>
@keyframes glow {
  0% {
    box-shadow: 0 0 0 0 #e3bb38;
  }
  
  50% {
    box-shadow: 0 0 10px 0 #e3bb38;
  }
}
.stripe-button {
  background: #e3bb38;
background: linear-gradient(to bottom, #d6ae2a 0%, #c5aa25 100%);
  border-color: black;
  color: black;
  cursor: pointer;
  overflow: hidden;
  position: relative;
  text-align: center;
  user-select: none;
  font-weight: bold;
  box-shadow: 0 0 0 0 #e3bb38;
  animation: glow 2s ease-out infinite;
}
.stripe-button .mask {
  background-color: rgba(255, 255, 255, 0.5);
  height: 6.25rem;
  position: absolute;
  transform: translate3d(-120%, -50px, 0) rotate3d(0, 0, 1, 45deg);
  transition: all 2s cubic-bezier(0.19, 1, 0.22, 1);
  width: 12.5rem;
}

.stripe-button:hover .mask {
  background-color: rgba(255, 255, 255, 1.0);
  transform: translate3d(120%, -100px, 0) rotate3d(0, 0, 1, 90deg);
}
</style>
