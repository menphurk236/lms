module.exports = {
  root: true,
  parserOptions: {
    parser: '@babel/eslint-parser',
    sourceType: 'module',
    requireConfigFile: false
  },
  extends: [
    '@nuxtjs'
  ],
  rules: {
    'vue/max-attributes-per-line': 'off',
    "no-unused-vars": "off",
    'vue/multi-word-component-names': 'off',
    "avoidEscape": true,
    "allowTemplateLiterals": true,
    "extrasemi": 0
  }
}
