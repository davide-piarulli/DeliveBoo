

<script>
export default {
  data(){
    
    return{

    }

  },

  props:{

    product:Object,

  }
  
};
</script>

<template>
  <div>

    <div class="small">
      <article class="recipe">
        <div class="pizza-box">
          <img
            src="https://brotokoll.com/wp-content/uploads/2019/12/xPSX_20190928_134709.jpg.pagespeed.ic.qsjw5ilFw5.jpg"
            width="1500"
            height="1368"
            alt=""
          />
        </div>
        <div class="recipe-content">
          <p class="recipe-tags">
            <span class="recipe-tag">Gluten Free</span>
            <span class="recipe-tag">Main dish</span>
          </p>

          <h1 class="recipe-title"><a href="#">{{product.name}}</a></h1>

          <p class="recipe-metadata">
            <span class="recipe-rating">★★★★<span>☆</span></span>
            <span class="recipe-votes">(12 votes)</span>
          </p>

          <p class="recipe-desc">
            It really is possible to make excellent gluten free pizza at home in
            your own oven with our recipes and techniques.
          </p>

          <button class="recipe-save" type="button">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="#000000"
            >
              <path
                d="M 6.0097656 2 C 4.9143111 2 4.0097656 2.9025988 4.0097656 3.9980469 L 4 22 L 12 19 L 20 22 L 20 20.556641 L 20 4 C 20 2.9069372 19.093063 2 18 2 L 6.0097656 2 z M 6.0097656 4 L 18 4 L 18 19.113281 L 12 16.863281 L 6.0019531 19.113281 L 6.0097656 4 z"
                fill="currentColor"
              />
            </svg>
            Save
          </button>
        </div>
      </article>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.recipe,
.pizza-box {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
}

.pizza-box {
  flex: 3 1 30ch;
  height: calc(282px + 5vw);
  overflow: hidden;

  img {
    max-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    object-fit: cover;
    object-position: 50% 50%;
  }
}

.recipe {
  border: 2px solid #f2f2f2;
  border-radius: 8px;
  overflow: hidden;

  &-content {
    padding: 16px 32px;
    flex: 4 1 40ch;
  }

  &-tags {
    margin: 0 -8px;
  }

  &-tag {
    display: inline-block;
    margin: 8px;
    font-size: 0.875em;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 0.02em;
    color: var(--primary);
  }

  &-title {
    margin: 0;
    font-size: clamp(1.4em, 2.1vw, 2.1em);
    font-family: "Roboto Slab", Helvetica, Arial, sans-serif;

    a {
      text-decoration: none;
      color: inherit;
    }
  }

  &-metadata {
    margin: 0;
  }

  &-rating {
    font-size: 1.2em;
    letter-spacing: 0.05em;
    color: var(--primary);

    span {
      color: var(--grey);
    }
  }

  &-votes {
    font-size: 0.825em;
    font-style: italic;
    color: var(--lightgrey);
  }

  &-save {
    display: flex;
    align-items: center;
    padding: 6px 14px 6px 12px;
    border-radius: 4px;
    border: 2px solid currentColor;
    color: var(--primary);
    background: none;
    cursor: pointer;
    font-weight: bold;

    svg {
      margin-right: 6px;
    }
  }
}

/* Body Layout */
* {
  box-sizing: border-box;
}

body {
  --primary: #e05d26;
  --grey: #454545;
  --lightgrey: #666;

  color: var(--grey);
  line-height: 1.55;
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  font-family: "Roboto", Helvetica, Arial, sans-serif;
}

.big {
  width: clamp(320px, 65%, 65%);
  padding: 24px;
}
.small {
  width: clamp(320px, 35%, 480px);
  padding: 24px;
}
</style>