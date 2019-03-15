const express = require("express");

const puppeteer = require('puppeteer');
const cheerio = require('cheerio');





const app = express();


app.get("/", async function(request, response){
	(async () => {
		  let ids = [];
		  const browser = await puppeteer.launch({
			  	//headless: true,
			  	timeout: 10000,
			  });
			  const page = await browser.newPage();
			  await page.goto('https://www.sberbank.ru/ru/fpartners/purchase/notification');
			  //await page.addScriptTag({url: 'https://code.jquery.com/jquery-3.2.1.min.js'});
			  await page.waitForSelector('.pager-pagination');
			  const html = await page.$$('.competitions-results__item');

			  for(const item of html){
			  	const link = await item.$('.competitions-results__item-link');
			  	const link_href = await page.evaluate(a =>  a.getAttribute('href'), link);
			  	ids.push(link_href);
			  }

			  await browser.close();
			  response.send(JSON.stringify({ids}));
			})();
		   
});

app.get('/parse/:id', function(request, response){
	(async () => {
		  let ids = [];
		  const browser = await puppeteer.launch({
			  	headless: true,
			  });
			  const page = await browser.newPage();
			  await page.goto('https://www.sberbank.ru/ru/fpartners/purchase/notification?id=' + request.params.id);
			  await page.waitForSelector('.purchase-details__additional-info__item-desc');
			 // await page.$eval('.purchase-details__docs-icon_icon_docx', el => { if(el.lengtn > 0) {let attr = `https://www.sberbank.ru${el.getAttribute('href')}`; return el.setAttribute('href', attr) }});
			  await page.$eval('.kit-button_color_orange', el => el.remove());
			  const customer = await page.$eval('.purchase-details__customer', e =>  e.innerHTML );
			  await page.$eval('.purchase-details__customer', el => el.remove());
			  const html = await page.$eval('.purchase-details', e => e.innerHTML);
			  await browser.close();
			  response.send(JSON.stringify({html, customer}));
			})();
});

app.listen(3000);


