module.exports = {
  extends: [
    'plugin:vue/vue3-recommended',
    'eslint:recommended'
  ],
  'parserOptions': {
    'ecmaVersion': 'latest',
    'sourceType': 'module'
  },
  rules: {
    'no-unused-vars': 1,
    'quotes': [2,'single',
      {
        'avoidEscape': true,
        'allowTemplateLiterals': true
      },
    ],
    'semi': [2, 'always'],
    'no-unreachable': 'off',
    'vue/html-quotes': ['off', 'double', { avoidEscape: false }],
    'vue/multi-word-component-names': 'off',
    'vue/require-default-prop': 'off',
    'vue/html-closing-bracket-spacing': 'off',
  }
};
