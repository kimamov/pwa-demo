<template>
  <div
    v-if="header && headerLayout !== 100"
    :class="headerClass"
    class="t3-ce-header prose"
  >
      <h1>TEST</h1>
    <component
      :is="`h${headerLevel}`"
      v-if="headerLayout >= 0 && headerLayout !== 100"
      :class="headerPosition"
    >
      <T3Link
        v-if="headerLink"
        :link="headerLink"
      >
        {{ header }}
      </T3Link>
      <template v-else>
        {{ header }}
      </template>
    </component>
    <component
      :is="`h${headerLevel + 1}`"
      v-if="subheader"
      :class="headerPosition"
    >
      {{ subheader }}
    </component>
  </div>
</template>

<script lang="ts" setup>
import type { T3CeBaseProps } from '@t3headless/nuxt-typo3'
import { useT3CeHeader } from '#typo3/components/T3CeHeader/useT3CeHeader'

const props = withDefaults(defineProps<T3CeBaseProps>(), {
  header: '',
  headerLayout: 0,
  headerPosition: '',
  headerLink: '',
  subheader: ''
})

const { headerLevel, headerClass } = useT3CeHeader(props)
</script>
