"use strict";function menuClose(){$menu.removeClass("is-open").delay(300).queue(function(e){$(this).hide(),e()}),$burger.removeClass("is-open"),unlockPage()}function menuOpen(){($aside.hasClass("is-open")||$authorization.hasClass("is-open"))&&(asideClose(),authorizationClose()),$burger.addClass("is-open"),$menu.show().delay(10).queue(function(e){$(this).addClass("is-open"),e()}),lockPage()}var $header=$(".js-header"),$burger=$header.find(".js-burger"),$menu=$header.find(".js-menu");$burger.on("click",function(){$menu.hasClass("is-open")?menuClose():menuOpen()});
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInBhcnRpYWxzL2hlYWRlci5qcyJdLCJuYW1lcyI6WyJtZW51Q2xvc2UiLCIkbWVudSIsInJlbW92ZUNsYXNzIiwiZGVsYXkiLCJxdWV1ZSIsIm5leHQiLCIkIiwidGhpcyIsImhpZGUiLCIkYnVyZ2VyIiwidW5sb2NrUGFnZSIsIm1lbnVPcGVuIiwiJGFzaWRlIiwiaGFzQ2xhc3MiLCIkYXV0aG9yaXphdGlvbiIsImFzaWRlQ2xvc2UiLCJhdXRob3JpemF0aW9uQ2xvc2UiLCJhZGRDbGFzcyIsInNob3ciLCJsb2NrUGFnZSIsIiRoZWFkZXIiLCJmaW5kIiwib24iXSwibWFwcGluZ3MiOiJBQUFBLFlBTUEsU0FBU0EsYUFDUEMsTUFBTUMsWUFBWSxXQUFXQyxNQUFNLEtBQUtDLE1BQU0sU0FBVUMsR0FDdERDLEVBQUVDLE1BQU1DLE9BQ1JILE1BRUZJLFFBQVFQLFlBQVksV0FDcEJRLGFBR0YsUUFBU0MsYUFDSEMsT0FBT0MsU0FBUyxZQUFjQyxlQUFlRCxTQUFTLGNBQ3hERSxhQUNBQyxzQkFHRlAsUUFBUVEsU0FBUyxXQUNqQmhCLE1BQU1pQixPQUFPZixNQUFNLElBQUlDLE1BQU0sU0FBVUMsR0FDckNDLEVBQUVDLE1BQU1VLFNBQVMsV0FDakJaLE1BRUZjLFdBeEJGLEdBQUlDLFNBQVVkLEVBQUUsY0FDWkcsUUFBVVcsUUFBUUMsS0FBSyxjQUN2QnBCLE1BQVFtQixRQUFRQyxLQUFLLFdBeUJ6QlosU0FBUWEsR0FBRyxRQUFTLFdBQ2RyQixNQUFNWSxTQUFTLFdBQ2pCYixZQUVBVyIsImZpbGUiOiJwYXJ0aWFscy9oZWFkZXIuanMiLCJzb3VyY2VzQ29udGVudCI6WyJcInVzZSBzdHJpY3RcIjtcblxudmFyICRoZWFkZXIgPSAkKCcuanMtaGVhZGVyJyk7XG52YXIgJGJ1cmdlciA9ICRoZWFkZXIuZmluZCgnLmpzLWJ1cmdlcicpO1xudmFyICRtZW51ID0gJGhlYWRlci5maW5kKCcuanMtbWVudScpO1xuXG5mdW5jdGlvbiBtZW51Q2xvc2UoKSB7XG4gICRtZW51LnJlbW92ZUNsYXNzKCdpcy1vcGVuJykuZGVsYXkoMzAwKS5xdWV1ZShmdW5jdGlvbiAobmV4dCkge1xuICAgICQodGhpcykuaGlkZSgpO1xuICAgIG5leHQoKTtcbiAgfSk7XG4gICRidXJnZXIucmVtb3ZlQ2xhc3MoJ2lzLW9wZW4nKTtcbiAgdW5sb2NrUGFnZSgpO1xufVxuXG5mdW5jdGlvbiBtZW51T3BlbigpIHtcbiAgaWYgKCRhc2lkZS5oYXNDbGFzcygnaXMtb3BlbicpIHx8ICRhdXRob3JpemF0aW9uLmhhc0NsYXNzKCdpcy1vcGVuJykpIHtcbiAgICBhc2lkZUNsb3NlKCk7XG4gICAgYXV0aG9yaXphdGlvbkNsb3NlKCk7XG4gIH1cblxuICAkYnVyZ2VyLmFkZENsYXNzKCdpcy1vcGVuJyk7XG4gICRtZW51LnNob3coKS5kZWxheSgxMCkucXVldWUoZnVuY3Rpb24gKG5leHQpIHtcbiAgICAkKHRoaXMpLmFkZENsYXNzKCdpcy1vcGVuJyk7XG4gICAgbmV4dCgpO1xuICB9KTtcbiAgbG9ja1BhZ2UoKTtcbn1cblxuJGJ1cmdlci5vbignY2xpY2snLCBmdW5jdGlvbiAoKSB7XG4gIGlmICgkbWVudS5oYXNDbGFzcygnaXMtb3BlbicpKSB7XG4gICAgbWVudUNsb3NlKCk7XG4gIH0gZWxzZSB7XG4gICAgbWVudU9wZW4oKTtcbiAgfVxufSk7Il19
