      // Render the PayPal button
      paypal.Button.render({
        // Set your environment
        env: 'production', // sandbox | production
        // Specify the style of the button
        style: {
            label: 'buynow',
            layout: 'vertical',  // horizontal | vertical
            size:   'medium',    // medium | large | responsive
            shape:  'rect',      // pill | rect
            color:  'white',       // gold | blue | silver | black
            tagline:  false,
            fandingicons: false
        },
        locale: 'ja_JP',
        // Specify allowed and disallowed funding sources
        //
        // Options:
        // - paypal.FUNDING.CARD
        // - paypal.FUNDING.CREDIT
        // - paypal.FUNDING.ELV
        funding: {
            allowed: [ ],
            disallowed: [ paypal.FUNDING.CREDIT, paypal.FUNDING.CARD ]
        },
        // Enable Pay Now checkout flow (optional)
        commit: true,
        // PayPal Client IDs - replace with your own
        // Create a PayPal app: https://developer.paypal.com/developer/applications/create
        client: {
          sandbox: 'AYDhAH1rHHq4jodEX_Dp2nQQc3lb_W4H_7Yvax5JTv9gzfIZmaKVEIC5t597TXBsn6OwL0yNiZqjfIkn',
          production: 'AZVLPsS37CHYl8QNjGSmIoxzl_ZdEJKN-3C0z885chvm4BYt0srctqAVZLWjyWhf3ntJI5JKYX2Kb9EU'
        },

        payment: function (data, actions) {
          return actions.payment.create({
            payment: {
              transactions: [
                {
                  amount: {total: '150',currency: 'JPY'}
                }
              ]
            }
          });
        },

        onAuthorize: function (data, actions) {
          return actions.payment.execute()
            .then(function () {
              // overlayの表示
              showLoadingOverlay();
              $form = $('form');
              $form.attr('action', $uri + '/complete');
              $form.attr('method', 'post');
              $form.submit();
            });
        },

        onCancel: function(data, actions) {
        }
      }, '#paypal-button-container');