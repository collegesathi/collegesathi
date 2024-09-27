const isElementLoaded = async (selector) => {
  while (document.querySelector(selector) === null) {
    await new Promise((resolve) => requestAnimationFrame(resolve));
  }
  return document.querySelector(selector);
};

isElementLoaded("#lsq-chatbot").then((e) => {
  let loggedInCounter = 1;
  let visitorCounter = 1;
  let utmCounter = 1;
  let customDataCounter = 1;
  let customInfoCounter = 1;
  let autoDetails = {};
  let details = {};
  let customDetails = {};

  function getlocation() {
    if ("geolocation" in navigator) {
      const location = {};
      navigator.geolocation.getCurrentPosition(
        function position({ coords: { latitude, longitude } }) {
          location["lat"] = latitude;
          location["long"] = longitude;
          autoDetails["location"] = location;
          e.contentWindow.postMessage(autoDetails, "*");
        },
        function ({ code, PERMISSION_DENIED, POSITION_UNAVAILABLE, TIMEOUT }) {
          e.contentWindow.postMessage(autoDetails, "*");
          switch (code) {
            case PERMISSION_DENIED:
              console.error("User denied the request for Geolocation.");
              break;
            case POSITION_UNAVAILABLE:
              console.error("Location information is unavailable.");
              break;
            case TIMEOUT:
              console.error("The request to get user location timed out.");
              break;
            default:
              console.error("An unknown error occurred.");
              break;
          }
        },
      );
    } else {
      e.contentWindow.postMessage(autoDetails, "*");
      console.error("Geolocation is not supported by this browser.");
    }
  }

  function system() {
    const system = {};
    const { userAgent, platform, cookieEnabled, language } = navigator;
    if (
      userAgent.includes("mobile") ||
      userAgent.includes("android") ||
      userAgent.includes("iphone") ||
      userAgent.includes("ipad")
    ) {
      system["deviceType"] = "Mobile";
    } else if (userAgent.includes("tablet") || userAgent.includes("ipad")) {
      system["deviceType"] = "Tablet";
    } else {
      system["deviceType"] = "Desktop";
    }
    system["platform"] = platform;
    system["cookieEnabled"] = cookieEnabled;
    system["language"] = language;
    if (Object.keys(system).length) {
      autoDetails["system"] = system;
    }
    getlocation();
  }

  function loggedInUser(info) {
    const userData = info.loggedInUserInfo ? info.loggedInUserInfo : {};
    Object.keys(userData).forEach((key) => {
      if (userData[key] === "" || !userData[key]) {
        delete userData[key];
      } else {
        if (
          ![
            "name",
            "email",
            "phoneNumber",
            "userId",
            "leadUniqueIdentifier",
            "customIntent",
            "ipAddress",
          ].includes(key)
        ) {
          userData["key-" + loggedInCounter] = userData[key];
          loggedInCounter++;
          delete userData[key];
        }
      }
    });
    if (Object.keys(userData).length) {
      details["loggedInUserInfo"] = userData;
    }
    utm(info);
  }

  function visitor(info) {
    const visitorData = info.visitorInfo;
    Object.keys(visitorData).forEach((key) => {
      if (visitorData[key] === "" || !visitorData[key]) {
        delete visitorData[key];
      } else {
        if (
          !["leadUniqueIdentifier", "customIntent", "ipAddress"].includes(key)
        ) {
          visitorData["key-" + visitorCounter] = visitorData[key];
          visitorCounter++;
          delete visitorData[key];
        }
      }
    });
    if (Object.keys(visitorData).length) {
      details["visitorInfo"] = visitorData;
    }
    loggedInUser(info);
  }

  function autoUtm() {
    const utm = {};
    var parentURL = window.location;
    var urlParams = new URLSearchParams(parentURL.search);

    var utmSource = urlParams.get("utm_source");
    var utmMedium = urlParams.get("utm_medium");
    var utmCampaign = urlParams.get("utm_campaign");
    var utmContent = urlParams.get("utm_content");
    var utmTerm = urlParams.get("utm_term");

    utmSource && (utm["utm_source"] = utmSource);
    utmMedium && (utm["utm_medium"] = utmMedium);
    utmCampaign && (utm["utm_campaign"] = utmCampaign);
    utmContent && (utm["utm_content"] = utmContent);
    utmTerm && (utm["utm_term"] = utmTerm);
    if (Object.keys(utm).length) {
      autoDetails["autoUTM"] = utm;
    }
    system();
  }

  function utm(info) {
    const utmData = info.utmInfo ? info.utmInfo : {};
    Object.keys(utmData).forEach((key) => {
      if (utmData[key] === "" || !utmData[key]) {
        delete utmData[key];
      } else {
        if (
          ![
            "utm_source",
            "utm_medium",
            "utm_campaign",
            "utm_content",
            "utm_term",
          ].includes(key)
        ) {
          utmData["key-" + utmCounter] = utmData[key];
          utmCounter++;
          delete utmData[key];
        }
      }
    });
    if (Object.keys(utmData).length) {
      details["utmInfo"] = utmData;
    }
    e.contentWindow.postMessage(details, "*");
  }

  function CONVERSE(info) {
    if (Object.keys(info.visitorInfo)) {
      visitor(info);
    } else {
      delete info.visitorInfo;
      loggedInUser(info);
    }
  }

  function TRIGGER_CHATBOT(params = {}) {
    const ele = document.getElementById("lsq-chatbot");
    if (!ele.classList.contains("chatbot-opened")) {
      const customData = params;
      Object.keys(customData).forEach((key) => {
        if (customData[key] === "" || !customData[key]) {
          delete customData[key];
        } else {
          if (
            !["customIntent", "leadUniqueIdentifier", "ipAddress"].includes(key)
          ) {
            customData["key-" + customDataCounter] = customData[key];
            customDataCounter++;
            delete customData[key];
          }
        }
      });
      ele.classList.add("chatbot-opened");
      ele.contentWindow.postMessage(
        { chatbotIsOpened: true, ...customData },
        "*",
      );
      ele.style.width = "388px";
    }
  }

  if (e) {
    autoUtm();

    window.CONVERSE = CONVERSE;
    window.TRIGGER_CHATBOT = TRIGGER_CHATBOT;

    // demonstrates the usage of TRIGGER_OPENING_OF_CHATBOT function
    // First way:
    // setTimeout(() => {
    //   window.TRIGGER_CHATBOT?.({ customIntent: 'Hello' });
    // }, 3000);
    // Second way:
    // <button onClick={() => window.TRIGGER_OPENING_OF_CHATBOT?.({ customIntent: 'Hello' })}>Click Me</button>

    window.addEventListener(
      "message",
      function (t) {
        if (!t.data.source) {
          const {
            isHelpText,
            chatOpened,
            height,
            width,
            bottom,
            right,
            left,
            isIframeContentRendered,
          } = t.data;

          if (isIframeContentRendered) {
            const data = { ...details, ...autoDetails, ...customDetails };
            if (Object.keys(data).length) {
              e.contentWindow.postMessage(data, "*");
            }
          }

          if (!isHelpText && isHelpText !== undefined) {
            e.style.height = "48px";
            e.style.width = "64px";
          } else if (
            isHelpText &&
            !Array.from(e.classList || []).includes("chatbot-opened")
          ) {
            e.style.removeProperty("height");
            e.style.removeProperty("width");
          }
          if (chatOpened) {
            e.classList.add("chatbot-opened");
            e.contentWindow.postMessage({ chatbotIsOpened: true }, "*");
          } else if (chatOpened === false) {
            e.classList.remove("chatbot-opened");
            e.contentWindow.postMessage({ chatbotIsOpened: false }, "*");
          }
          if (height === 0 && width === 0) {
            e.style.removeProperty("height");
            e.style.removeProperty("width");
          } else {
            e.style.height = Number.isInteger(height) ? height + "px" : height;
            e.style.width = Number.isInteger(width) ? width + "px" : width;
          }

          if (bottom || right || left) {
            if (bottom) {
              e.style.bottom = Number.isInteger(bottom)
                ? bottom + "px"
                : bottom;
            } else {
              e.style.removeProperty("bottom");
            }
            if (right) {
              e.style.right = Number.isInteger(right) ? right + "px" : right;
            } else {
              e.style.removeProperty("right");
            }
            if (left) {
              e.style.left = Number.isInteger(left) ? left + "px" : left;
            } else {
              e.style.removeProperty("left");
            }
          }
        }
      },
      !1,
    );
  }
});
