export default defineNuxtPlugin(() => {
  const { setOption } = useT3Api()

  setOption('credentials', 'include');
  //
  // setOption('onRequest', (context) => {
  //   console.log('on request: ', context)
  // })
  //
  // setOption('onRequestError', (context) => {
  //   console.log('on request error: ', context)
  // })
  //
  // setOption('onResponse', (context) => {
  //   console.log('on response: ', context)
  // })
  //
  // setOption('onResponseError', (context) => {
  //   console.log('on response error: ', context)
  // })
})
