<!DOCTYPE html>

<head>
  <title>Part 1 - requirement gathering questionnaires</title>
</head>

<body>
  <div id="questionnaire1Container"></div>
  <script src="dashboard/JS/questionnaire1CssVariables.js"></script>
  <script>
    const questionnaire1Json = {
      "pages": [{
        "name": "page1",
        "elements": [{
            "type": "radiogroup",
            "name": "specificType",
            "title": "Are you looking for a specific style or type of website?",
            "defaultValue": "Other",
            "choices": [
              "Other",
              "Design Portfolio",
              "Web store",
              "Resturant",
              "Cleaning Company",
              "Plumbing Service",
              "Car Workshop",
              "English Pub",
              "Construction Company",
              "Dry Cleaning",
              "Business Consulting",
              "Flower Shop"
            ],
            "colCount": 2
          },
          {
            "type": "panel",
            "name": "panel2",
            "elements": [{
                "type": "imagepicker",
                "name": "preferredDesign",
                "title": "What design do you prefer?",
                "isRequired": true,
                "choices": [{
                    "value": "Modern",
                    "imageLink": "https://www.digitalsilk.com/wp-content/uploads/2022/12/Modern-web-design-company-custom-websites.png.webp"
                  },
                  {
                    "value": "Corporate",
                    "imageLink": "https://www.digitalsilk.com/wp-content/uploads/2023/04/corporate-website-design-services-featured-collage-658x590.png.webp"
                  },
                  {
                    "value": "Clean",
                    "imageLink": "https://cdn.dribbble.com/userupload/7633438/file/original-499b622a3706872e06bcbc76b7a8fcae.png?resize=400x0"
                  },
                  {
                    "value": "Artistic",
                    "imageLink": "https://i.pinimg.com/originals/87/5b/2a/875b2ab63d213c9b730ff7a1cd71ee1b.png"
                  }
                ],
                "minImageWidth": 250,
                "showLabel": true
              },
              {
                "type": "radiogroup",
                "name": "atmosphere",
                "title": "Tone and Atmosphere",
                "choices": [
                  "Light",
                  "Dark"
                ],
                "colCount": 2
              }
            ]
          },
          {
            "type": "matrixdropdown",
            "name": "colourScheme",
            "title": "Select the general colour of website for colour scheme",
            "columns": [{
                "name": "Primary",
                "cellType": "text",
                "inputType": "color"
              },
              {
                "name": "Secondary",
                "cellType": "text",
                "inputType": "color"
              },
              {
                "name": "Tertiary",
                "cellType": "text",
                "inputType": "color"
              }
            ],
            "choices": [
              1,
              2,
              3,
              4,
              5
            ],
            "cellType": "text",
            "rows": [
              "Colour"
            ]
          },
          {
            "type": "matrixdropdown",
            "name": "targLocation",
            "title": "What is your target audience?",
            "columns": [{
                "name": "Column 1",
                "title": "The Perfect Audience is"
              },
              {
                "name": "Column 2",
                "title": "A Great Audience is"
              },
              {
                "name": "Column 3",
                "title": "A Good Audience is"
              },
              {
                "name": "Column 4",
                "title": "Another Target is"
              }
            ],
            "choices": [
              1,
              2,
              3,
              4,
              5
            ],
            "cellType": "text",
            "rows": [
              "Suburb",
              "City",
              "Country"
            ]
          },
          {
            "type": "panel",
            "name": "panel1",
            "elements": [{
                "type": "tagbox",
                "name": "targGender",
                "title": "Gender:",
                "titleLocation": "top",
                "choices": [{
                    "value": "Item 1",
                    "text": "Male"
                  },
                  {
                    "value": "Item 2",
                    "text": "Female"
                  },
                  {
                    "value": "Item 3",
                    "text": "Other"
                  }
                ],
                "showSelectAllItem": true,
                "selectAllText": "All"
              },
              {
                "type": "text",
                "name": "targLifestyle",
                "title": "Lifestyle:"
              },
              {
                "type": "text",
                "name": "targAge",
                "title": "Age:"
              },
              {
                "type": "text",
                "name": "targIncome",
                "title": "Socio economic / Income:"
              },
              {
                "type": "text",
                "name": "targLikes",
                "title": "Likes / Dislikes:"
              }
            ],
            "title": "Targeted audience demographic"
          },
          {
            "type": "panel",
            "name": "panel3",
            "elements": [{
                "type": "text",
                "name": "compName",
                "title": "Company name:",
                "isRequired": true
              },
              {
                "type": "text",
                "name": "compPhone",
                "title": "Phone:",
                "isRequired": true,
                "inputType": "tel"
              },
              {
                "type": "text",
                "name": "address",
                "title": "Address:"
              },
              {
                "type": "comment",
                "name": "addDescript",
                "title": "Add description and history of the company"
              }
            ],
            "title": "Add your Contact details"
          },
          {
            "type": "panel",
            "name": "panel4",
            "elements": [{
                "type": "comment",
                "name": "addInfo",
                "title": "Add additional information to let us know exactly how can your website be perfect"
              },
              {
                "type": "text",
                "name": "emailAddr",
                "title": "Your email address",
                "isRequired": true,
                "inputType": "email"
              }
            ]
          }
        ]
      }],
      "showCompletedPage": false,
      "showQuestionNumbers": "off",
      "completeText": "Let's Configure",
      "widthMode": "static",
      "width": "850px"
    };

    const questionnaire1 = new Survey.Model(questionnaire1Json);

    //CSS properties of the form
    questionnaire1.applyTheme(questionnaire1CssVariables);

    $(function() {
      $("#questionnaire1Container").Survey({
        model: questionnaire1
      });
    });

    /*
    function processResult1(sender) {
      const result1Data = {
        "elements": []
      };
      for (const key in questionnaire1.data) {
        const question = questionnaire1.getQuestionByName(key);
        if (!!question) {
          const item = {
            name: key,
            question: question.title,
            value: question.value,
            answer: question.displayValue,
          };
          result1Data.elements.push(item);
        }
      }
      result1 = result1Data;
      alert(JSON.stringify(result1Data));
      console.log(JSON.stringify(result1Data));
    };
    */

    var result1 = {};
    // all questions as questions as an array inside "elements" key
    function processResult1(sender) {
      const result1Data = {
        elements: [] // Initialize result1Data as an object with an 'elements' key
      };
      const allQuestions = sender.getAllQuestions();
      for (const question of allQuestions) {
        let value = question.value;
        if (question.name === 'colourScheme' || question.name === 'targLocation') {
          value = value || {}; // Set value to {} if it is undefined or null for specific questions
        }
        const item = {
          name: question.name,
          question: question.title,
          value: value,
          answer: question.displayValue,
        };
        result1Data.elements.push(item);
      }
      result1 = result1Data;
      //console.log(JSON.stringify(result1Data));
    }



    questionnaire1.onComplete.add(processResult1);
  </script>


</body>

</html>