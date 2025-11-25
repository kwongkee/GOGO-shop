(function() {
  window.parent.postMessage({
    type: 'baidu_share_request'
  }, 'https://www.gogo198.cn'); // 替换为您的实际域名

  window.addEventListener('message', function(event) {
    if (event.origin !== 'https://www.gogo198.cn') return;
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    
    fetch('https://www.gogo198.cn/get_miniprogram', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify({})
    })
    .then(response => {
      if (response.ok && response.headers.get('content-type').includes('application/json')) {
        return response.json();
      } else {
        return response.text().then(text => {
          throw new Error(`Server returned non-JSON: ${text.substring(0, 200)}...`);
        });
      }
    })
    .then(result => {
      event.source.postMessage({
        type: 'baidu_share_response',
        result: result
      }, event.origin);
    })
    .catch(error => {
      event.source.postMessage({
        type: 'baidu_share_error',
        message: error.message
      }, event.origin);
    });
  }, false);
})();