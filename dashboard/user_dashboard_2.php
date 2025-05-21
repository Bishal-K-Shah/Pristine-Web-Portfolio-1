<!DOCTYPE html>
<html>

<head>
  <title>Part 2 - Price-based questionnaire</title>
  <style>
    #totalPrice {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: white;
      padding: 5px;
      border: 1px solid #ccc;
      font-size: 24px;
      font-weight: bold;
      color: rgb(14, 170, 14);
      z-index: 9999;
    }
  </style>
</head>

<body>
  <div id="totalPrice">$0.00</div>

  <div id="questionnaire2Container"></div>

  <script>
    const questionnaire2Json = {
      logoPosition: "right",
      completedHtml: "<h3>Thank you for completing the questionnaire. Email is being sent. Please Wait...</h3>",
      completedBeforeHtml: "<h3>Our records show that you have already completed the questionnaire.</h3>",
      pages: [{
          name: "page1",
          elements: [{
              type: "radiogroup",
              name: "question1",
              useDisplayValuesInDynamicTexts: false,
              title: "Website Type",
              isRequired: true,
              description: "What type of website is it?",
              choices: [{
                  value: "1500",
                  text: "Business",
                },
                {
                  value: "500",
                  text: "Personal ",
                },
                {
                  value: "3000",
                  text: "E-commerce",
                },
              ],
            },
            {
              type: "panel",
              name: "panel1",
              elements: [{
                  type: "checkbox",
                  name: "question2",
                  title: "Pages",
                  description: "What pages do you need?",
                  isRequired: true,
                  choices: [{
                      value: "300",
                      text: "Home page",
                    },
                    {
                      value: "200",
                      text: "Contact page",
                    },
                    {
                      value: "300.002",
                      text: "Gallery page",
                    },
                    {
                      value: "200.001",
                      text: "About page",
                    },
                    {
                      value: "100",
                      text: "FAQ page",
                    },
                    {
                      value: "300.001",
                      text: "Contact + About page in one",
                    },
                  ],
                  colCount: 2,
                },
                {
                  type: "matrixdynamic",
                  name: "question3",
                  title: "Content Page",
                  description: "These are informational pages such as Articles, News, Blogs, or Content for specific topics.",
                  columns: [{
                      name: "column1",
                      title: "Custom Page Name",
                    },
                    {
                      name: "column2",
                      title: "Description",
                      cellType: "comment",
                      rows: 1,
                    },
                  ],
                  choices: [1, 2, 3, 4, 5],
                  cellType: "text",
                  rowCount: 1,
                  addRowText: "Add Page",
                },
                {
                  type: "checkbox",
                  name: "question4",
                  visible: false,
                  visibleIf: "{question1} = 3000",
                  title: "eCommerce pages",
                  readOnly: true,
                  choices: [
                    " Product Page",
                    " Cart Page",
                    " Order History Page",
                    " Wishlist Page",
                  ],
                },
                {
                  type: "checkbox",
                  name: "question5",
                  title: "Legal Information pages",
                  choices: [{
                      value: "300",
                      text: "Terms & Conditions page",
                    },
                    {
                      value: "300.001",
                      text: "Privacy Policy page",
                    },
                  ],
                },
              ],
            },
            {
              type: "checkbox",
              name: "question6",
              title: "Content Management",
              description: "Do you need CMS to manage the content of the website?",
              choices: [{
                value: "200",
                text: "CMS admin dashboard page",
              }, ],
            },
          ],
        },
        {
          name: "page2",
          elements: [{
              type: "panel",
              name: "AccountPages",
              elements: [{
                  type: "boolean",
                  name: "question7",
                  title: "Account Pages",
                  description: "Do you need user account feature?",
                  valueTrue: "300",
                },
                {
                  type: "radiogroup",
                  name: "question8",
                  visibleIf: "{question7} = 300",
                  title: " ",
                  hideNumber: true,
                  choices: [{
                      value: " Login page and Sign up page",
                      text: "Login page and Sign up page",
                    },
                    " Login + Sign up in one page",
                    {
                      value: " Login/signup directly using pop-up",
                      text: "Login/signup directly using pop-up",
                    },
                  ],
                },
                {
                  type: "boolean",
                  name: "question9",
                  visibleIf: "{question8} = ' Login page and Sign up page' or {question8} = ' Login + Sign up in one page'",
                  title: "Login pop-up feature",
                  description: "Add Login pop-up feature from homepage",
                  valueTrue: "75",
                },
              ],
            },
            {
              type: "checkbox",
              name: "question10",
              title: "Express Login",
              description: "Option to fast Login from other account",
              choices: [{
                  value: "80",
                  text: "Google account",
                },
                {
                  value: "80.001",
                  text: "Facebook account",
                },
              ],
            },
            {
              type: "boolean",
              name: "question11",
              title: "Interactive Map",
              description: "Do you need an Interactive map on the Contact page?",
              valueTrue: "90",
            },
            {
              type: "boolean",
              name: "question12",
              title: "Booking System",
              description: "Do you need Booking system to book appointments, tickets, calls, etc.?",
              valueTrue: "300",
            },
          ],
        },
        {
          name: "page3",
          elements: [{
              type: "panel",
              name: "panel2",
              elements: [{
                  type: "boolean",
                  name: "question13",
                  title: "Do you need Payment Gateway?",
                },
                {
                  type: "checkbox",
                  name: "question14",
                  visibleIf: "{question13} = true",
                  hideNumber: true,
                  title: " Payment accepting and checkout methods",
                  choices: [{
                      value: "200",
                      text: "Credit and debit card",
                    },
                    {
                      value: "100",
                      text: "Paypal",
                    },
                    {
                      value: "100.001",
                      text: "Google Pay",
                    },
                    {
                      value: "100.002",
                      text: "Apple Pay",
                    },
                  ],
                  colCount: 2,
                },
                {
                  type: "checkbox",
                  name: "question15",
                  visibleIf: "{question13} = true",
                  hideNumber: true,
                  title: "BNPL company",
                  description: "Buy now, Pay later for Loan and installments payment service",
                  choices: [{
                      value: "100",
                      text: "AfterPay",
                    },
                    {
                      value: "100.001",
                      text: "ZipPay",
                    },
                    {
                      value: " 100.002",
                      text: "Klarna",
                    },
                  ],
                },
              ],
              title: "Payment gateway",
            },
            {
              type: "checkbox",
              name: "question16",
              title: "Express Checkout",
              choices: [{
                  value: "100",
                  text: "Paypal Express Checkout",
                },
                {
                  value: "100.001",
                  text: " Stripe Express Checkout",
                },
              ],
            },
            {
              type: "boolean",
              name: "question17",
              title: "Blog",
              description: "Do you want to add a blogging feature to the site?",
              valueTrue: "300",
            },
            {
              type: "boolean",
              name: "question18",
              title: "Social Media Live Feed",
              description: "Do you want to include social media live feed on your page?",
              valueTrue: "300",
            },
          ],
        },
        {
          name: "page4",
          elements: [{
              type: "boolean",
              name: "question19",
              title: "Newsletter feature",
              description: "Do you want to add newsletter function to the website?",
              valueTrue: "200",
            },
            {
              type: "boolean",
              name: "question24",
              title: "Logo",
              description: "Do you want the logo created?",
              valueTrue: "100",
            },
            {
              type: "panel",
              name: "panel3",
              elements: [{
                  type: "radiogroup",
                  name: "question20",
                  title: "Design Package",
                  isRequired: true,
                  choices: [{
                      value: "0",
                      text: "Tier 1 - Standard",
                    },
                    {
                      value: "15",
                      text: "Tier 2 - Gold (+15%)",
                    },
                    {
                      value: "30",
                      text: "Tier 3 - Platinum (30%)",
                    },
                  ],
                  colCount: 3,
                },
                {
                  type: "html",
                  name: "Design Information",
                  visibleIf: "{More Information} = true",
                  html: "  <style>\n    .card-container {\n      display: flex;\n    }\n\n    .card {\n      width: 800px;\n      padding: 20px;\n      margin: 10px;\n      border-radius: 10px;\n      text-align: left;\n      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);\n      background-color: #fff;\n    }\n    .card h5 {\n      margin-bottom: 10px;\n    }\n\n    .card ul {\n      list-style: disc;\n      padding: 0px 0px 0px 10px;\n    }\n  </style>\n<div class=\"card-container\">\n    <div class=\"card\" id=\"tier1\">\n      <b>Tier 1: Standard Templates, Exceptional Quality</b>\n      <ul>\n        <li>Sleek and Modern Design</li>\n        <li>Mobile-Responsive</li>\n        <li>Optimized for Speed and Performance</li>\n      </ul>\n    </div>\n\n    <div class=\"card\" id=\"tier2\">\n     <b>Tier 2: Original Designs for a Unique Identity</b>\n      <ul>\n        <li>Custom Design Concepts</li>\n        <li>Interactive and Engaging Elements</li>\n        <li>Personalized User Experience</li>\n      </ul>\n    </div>\n\n    <div class=\"card\" id=\"tier3\">\n      <b>Tier 3: Premium Ground-Up Designs for Unmatched Excellence</b>\n      <ul>\n        <li>Bespoke, Tailored Design</li>\n        <li>Cutting-Edge Technology</li>\n        <li>Unlimited Customization</li>\n      </ul>\n    </div>\n  </div>\n",
                },
                {
                  type: "boolean",
                  name: "More Information",
                  hideNumber: true,
                  defaultValue: "indeterminate",
                  labelTrue: "Show",
                  labelFalse: "Hide",
                },
              ],
            },
            {
              type: "radiogroup",
              name: "question21",
              title: "SSL Certification",
              description: "Do you need an SSL certificate? (Price based on level of security, bought from Certificate Authority)",
              choices: [{
                  value: "60",
                  text: "DV Certificate - For sites, such as blogs or small business websites",
                },
                {
                  value: "110",
                  text: " OV certificate - For sites, such as business websites with forms and lead capture capabilities",
                },
                {
                  value: "210",
                  text: " EV certificate - For the highest level of security, capable of handling sensitive information",
                },
              ],
            },
            {
              type: "radiogroup",
              name: "question22",
              title: "Website delivery date",
              description: "When do you need the website created?",
              isRequired: true,
              choices: [{
                  value: "0",
                  text: "3 months - Standard delivery",
                },
                {
                  value: "30",
                  text: "2 months - Express delivery (+30%)",
                },
                {
                  value: "50",
                  text: "4 weeks - Expedited service (+50%)",
                },
              ],
            },
            {
              type: "expression",
              name: "totalPrice",
              title: "Total",
              hideNumber: true,
              expression: "{varTotal}",
              displayStyle: "currency",
              maximumFractionDigits: 2,
            },
          ],
        },
      ],
      triggers: [{
          type: "runexpression",
        },
        {
          type: "setvalue",
          expression: "{question1} = 3000",
          setToName: "question4",
          setValue: [
            " Product Page",
            " Cart Page",
            " Order History Page",
            " Wishlist Page",
          ],
        },
        {
          type: "setvalue",
          expression: "{question2} allof [200, 300.001] or {question2} allof [200.001, 300.001]",
          setToName: "question2",
        },
        {
          type: "setvalue",
          expression: "{question13} = false",
          setToName: "question14",
        },
        {
          type: "setvalue",
          expression: "{question7} = false",
          setToName: "question9"
        }
      ],
      calculatedValues: [{
          name: "varDesignPackageAmount",
          expression: "({question20}/100)*{varSubTotal}",
        },
        {
          name: "varDeliveryAmount",
          expression: "({question22}/100)*({varSubTotal}+{varDesignPackageAmount})",
        },
        {
          name: "varNoOfContentPage",
          expression: "count({question3})",
        },
        {
          name: "varContentPageRate",
          expression: "200",
        },
        {
          name: "varContentPageAmount",
          expression: "{varNoOfContentPage}*{varContentPageRate}",
        },
        {
          name: "varSubTotal",
          expression: "sum({question1},{question2},{varContentPageAmount},{question5},{question6},{question7},{question9},{question10},{question11},{question12},{question14},{question15},{question16},{question17},{question18},{question19},{question21},{question24})",
        },
        {
          name: "varTotal",
          expression: "{varSubTotal}+{varDesignPackageAmount}+{varDeliveryAmount}",
        },
      ],
      showPreviewBeforeComplete: "showAllQuestions",
      widthMode: "static",
      width: "850px",
    };

    const questionnaire2 = new Survey.Model(questionnaire2Json);

    //CSS properties of the form
    questionnaire2.applyTheme({
      cssVariables: {
        "--sjs-primary-backcolor": "#CD0A0A",
        "--sjs-primary-backcolor-light": "rgba(205, 29, 62, 0.1)",
        "--sjs-primary-backcolor-dark": "rgba(171, 24, 52, 1)",
      },
      colorPalette: "light",
    });

    $(function() {
      $("#questionnaire2Container").Survey({
        model: questionnaire2,
      });
    });

    function updateTotalPrice() {
      totalPrice = document.getElementById("totalPrice").innerHTML =
        "$" + questionnaire2.getVariable("varTotal").toFixed(2);
    }

    questionnaire2.onValueChanged.add(updateTotalPrice);

    function formatValue(value) {
      if (typeof value === "number") {
        // Round the number to 2 decimal places
        return Math.round(value * 100) / 100;
      } else if (typeof value === "string") {
        // Try to convert the string to a number
        const numericValue = parseFloat(value);
        if (!isNaN(numericValue)) {
          // If conversion successful, round to 2 decimal places
          return Math.round(numericValue * 100) / 100;
        }
      } else if (Array.isArray(value)) {
        // Process each element in the array recursively
        return value.map((item) => formatValue(item));
      }
      // For other types or values that can't be converted, return as-is
      return value;
    }

    var resultData = {};
    // all questions as an key-value pair
    function processResult2(sender) {
      const result2Data = {}; // Initialize result2Data as an object
      const allQuestions = sender.getAllQuestions();
      for (const question of allQuestions) {
        let priceValue;
        // Check if the value is an empty array and set priceValue to empty string if true
        if (Array.isArray(question.value) && question.value.length === 0) {
          priceValue = '';
        } else {
          priceValue = question.value !== undefined ? formatValue(question.value) : '';
        }
        const item = {
          name: question.name,
          question: question.title,
          value: priceValue,
          answer: question.displayValue,
        };
        result2Data[question.name] = item; // Use the question name as the key
      }

      //additional data
      result2Data.calcValues = {
        varContentPageRate: formatValue(questionnaire2.getVariable("varContentPageRate")),
        varDesignPackageAmount: formatValue(questionnaire2.getVariable("varDesignPackageAmount")),
        varDeliveryAmount: formatValue(questionnaire2.getVariable("varDeliveryAmount")),
      };

      resultData = {
        ...result2Data,
        ...result1
      };
      //console.log(JSON.stringify(resultData));

      // Send the data to the server
      $.ajax({
        type: "POST",
        url: "dashboard/submit_result.php",
        data: {
          resultData: JSON.stringify(resultData) // Convert resultData to a string
        },
        success: function(response) {
          alert("Data saved in database and email sent successfully");
          //reload page
          location.reload();
          console.log(response);
        },
        error: function(xhr, status, error) {
          alert("Error saving data");
          console.log(xhr.responseText);
        },
      });
    }

    questionnaire2.onComplete.add(processResult2);
  </script>
</body>

</html>