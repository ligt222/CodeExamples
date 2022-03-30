"use strict";function generateBreadcrumbs(r,e){for(var n,t,u=[1,2,3,r-1,r,r+1,e-2,e-1,e].filter(function(r,n,t){return r>0&&r<=e&&t.indexOf(r)===n}).sort(function(r,e){return r-e}),i=-1;u[i++ +1];)n=u[i+1]-u[i],n>1&&(t=2===n?u[i]+1:"...",u.splice(++i,0,t));return u}
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInBhcnRpYWxzL3V0aWxpdGVzL2dlbmVyYXRlQnJlYWRjcnVtYnMuanMiXSwibmFtZXMiOlsiZ2VuZXJhdGVCcmVhZGNydW1icyIsImN1ciIsImVuZCIsImRpZmYiLCJwaCIsImFyciIsImZpbHRlciIsImUiLCJpIiwiYSIsImluZGV4T2YiLCJzb3J0IiwiYiIsInNwbGljZSJdLCJtYXBwaW5ncyI6IkFBQUEsWUFTQSxTQUFTQSxxQkFBb0JDLEVBQUtDLEdBVWhDLElBVEEsR0FNSUMsR0FDQUMsRUFQQUMsR0FBTyxFQUFHLEVBQUcsRUFBR0osRUFBTSxFQUFHQSxFQUFLQSxFQUFNLEVBQUdDLEVBQU0sRUFBR0EsRUFBTSxFQUFHQSxHQUFLSSxPQUFPLFNBQVVDLEVBQUdDLEVBQUdDLEdBQ3ZGLE1BQU9GLEdBQUksR0FBS0EsR0FBS0wsR0FBT08sRUFBRUMsUUFBUUgsS0FBT0MsSUFDNUNHLEtBQUssU0FBVUYsRUFBR0csR0FDbkIsTUFBT0gsR0FBSUcsSUFFVEosS0FJR0gsRUFBSUcsS0FBTSxJQUNmTCxFQUFPRSxFQUFJRyxFQUFJLEdBQUtILEVBQUlHLEdBRXBCTCxFQUFPLElBQ1RDLEVBQWMsSUFBVEQsRUFBYUUsRUFBSUcsR0FBSyxFQUFJLE1BQy9CSCxFQUFJUSxTQUFTTCxFQUFHLEVBQUdKLEdBSXZCLE9BQU9DIiwiZmlsZSI6InBhcnRpYWxzL3V0aWxpdGVzL2dlbmVyYXRlQnJlYWRjcnVtYnMuanMiLCJzb3VyY2VzQ29udGVudCI6WyJcInVzZSBzdHJpY3RcIjtcblxuLyoqXG4gKiDQktC10YDRgdC40Y8g0LTQu9GPIGVzNVxuICog0JPQtdC90LXRgNC40YDRg9C10YIg0YXQu9C10LHQvdGL0LUg0LrRgNC+0YjQutC4LlxuICpcbiAqIEBwYXJhbSAge251bWJlcn0gY3VyIC0g0YLQtdC60YPRidCw0Y8g0YHRgtGA0LDQvdC40YbQsFxuICogQHBhcmFtICB7bnVtYmVyfSBlbmQgLSDQv9C+0YHQu9C10LTQvdGP0Y8g0YHRgtGA0LDQvdC40YbQsFxuICovXG5mdW5jdGlvbiBnZW5lcmF0ZUJyZWFkY3J1bWJzKGN1ciwgZW5kKSB7XG4gIHZhciBhcnIgPSBbMSwgMiwgMywgY3VyIC0gMSwgY3VyLCBjdXIgKyAxLCBlbmQgLSAyLCBlbmQgLSAxLCBlbmRdLmZpbHRlcihmdW5jdGlvbiAoZSwgaSwgYSkge1xuICAgIHJldHVybiBlID4gMCAmJiBlIDw9IGVuZCAmJiBhLmluZGV4T2YoZSkgPT09IGk7XG4gIH0pLnNvcnQoZnVuY3Rpb24gKGEsIGIpIHtcbiAgICByZXR1cm4gYSAtIGI7XG4gIH0pO1xuICB2YXIgaSA9IC0xO1xuICB2YXIgZGlmZjtcbiAgdmFyIHBoO1xuXG4gIHdoaWxlIChhcnJbaSsrICsgMV0pIHtcbiAgICBkaWZmID0gYXJyW2kgKyAxXSAtIGFycltpXTtcblxuICAgIGlmIChkaWZmID4gMSkge1xuICAgICAgcGggPSBkaWZmID09PSAyID8gYXJyW2ldICsgMSA6ICcuLi4nO1xuICAgICAgYXJyLnNwbGljZSgrK2ksIDAsIHBoKTtcbiAgICB9XG4gIH1cblxuICByZXR1cm4gYXJyO1xufSJdfQ==