USE [master]
GO
/****** Object:  Database [Luna_WebDB]    Script Date: 2/10/2019 10:32:52 PM ******/
CREATE DATABASE [Luna_WebDB]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'Luna_WebDB', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL11.SQLEXPRESS\MSSQL\DATA\Luna_WebDB.mdf' , SIZE = 3136KB , MAXSIZE = UNLIMITED, FILEGROWTH = 1024KB )
 LOG ON 
( NAME = N'Luna_WebDB_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL11.SQLEXPRESS\MSSQL\DATA\Luna_WebDB_log.ldf' , SIZE = 832KB , MAXSIZE = 2048GB , FILEGROWTH = 10%)
GO
ALTER DATABASE [Luna_WebDB] SET COMPATIBILITY_LEVEL = 110
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [Luna_WebDB].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [Luna_WebDB] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [Luna_WebDB] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [Luna_WebDB] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [Luna_WebDB] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [Luna_WebDB] SET ARITHABORT OFF 
GO
ALTER DATABASE [Luna_WebDB] SET AUTO_CLOSE ON 
GO
ALTER DATABASE [Luna_WebDB] SET AUTO_CREATE_STATISTICS ON 
GO
ALTER DATABASE [Luna_WebDB] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [Luna_WebDB] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [Luna_WebDB] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [Luna_WebDB] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [Luna_WebDB] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [Luna_WebDB] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [Luna_WebDB] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [Luna_WebDB] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [Luna_WebDB] SET  ENABLE_BROKER 
GO
ALTER DATABASE [Luna_WebDB] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [Luna_WebDB] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [Luna_WebDB] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [Luna_WebDB] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [Luna_WebDB] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [Luna_WebDB] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [Luna_WebDB] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [Luna_WebDB] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [Luna_WebDB] SET  MULTI_USER 
GO
ALTER DATABASE [Luna_WebDB] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [Luna_WebDB] SET DB_CHAINING OFF 
GO
ALTER DATABASE [Luna_WebDB] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [Luna_WebDB] SET TARGET_RECOVERY_TIME = 0 SECONDS 
GO
USE [Luna_WebDB]
GO
/****** Object:  Table [dbo].[donatepage]    Script Date: 2/10/2019 10:32:52 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[donatepage](
	[content] [varchar](max) NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[itemcategory]    Script Date: 2/10/2019 10:32:52 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[itemcategory](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[categoryname] [varchar](50) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[itemlog]    Script Date: 2/10/2019 10:32:52 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[itemlog](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[itemid] [int] NOT NULL,
	[resourceid] [varchar](50) NOT NULL,
	[itemprice] [int] NOT NULL,
	[itemdiscount] [int] NOT NULL,
	[itemfinalprice] [int] NOT NULL,
	[accountid] [int] NOT NULL,
	[qty] [int] NOT NULL,
	[accountbalb] [int] NOT NULL,
	[accountbala] [int] NOT NULL,
	[currency] [varchar](20) NULL,
	[date] [date] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[itemmall]    Script Date: 2/10/2019 10:32:52 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[itemmall](
	[itemid] [int] IDENTITY(1,1) NOT NULL,
	[itemname] [varchar](50) NOT NULL,
	[itemimage] [varchar](50) NOT NULL,
	[itemtype] [int] NOT NULL,
	[itemdiscount] [int] NULL,
	[itempricemoon] [int] NULL,
	[itemseal] [int] NULL,
	[itempricestar] [int] NULL,
	[itemdesc] [varchar](max) NULL,
	[isSet] [int] NOT NULL,
	[itemvalue1] [varchar](500) NULL,
	[itemvalue2] [varchar](500) NULL,
	[itemvalue3] [varchar](500) NULL,
	[itemvalue4] [varchar](500) NULL,
	[itemvalue5] [varchar](500) NULL,
	[itemvalue6] [varchar](500) NULL,
	[itemsetopt] [varchar](max) NULL,
 CONSTRAINT [PK__itemmall__3213E83F8EFA6361] PRIMARY KEY CLUSTERED 
(
	[itemid] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[media]    Script Date: 2/10/2019 10:32:52 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[media](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[mediaimage] [varchar](50) NOT NULL,
 CONSTRAINT [PK_media] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[news]    Script Date: 2/10/2019 10:32:52 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[news](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[title] [varchar](100) NOT NULL,
	[categoryname] [varchar](30) NOT NULL,
	[date] [date] NOT NULL,
	[content] [varchar](max) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tospage]    Script Date: 2/10/2019 10:32:52 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tospage](
	[content] [varchar](max) NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
INSERT [dbo].[donatepage] ([content]) VALUES (N'<h2>DONATE NOW</h2>

<p><img alt="" src="/LunaFinal/res/upload/images/bg2.png" style="height:50px; width:287px" /></p>
')
SET IDENTITY_INSERT [dbo].[itemcategory] ON 

INSERT [dbo].[itemcategory] ([id], [categoryname]) VALUES (1, N'Equipment')
INSERT [dbo].[itemcategory] ([id], [categoryname]) VALUES (2, N'Costume')
INSERT [dbo].[itemcategory] ([id], [categoryname]) VALUES (3, N'Accesories')
INSERT [dbo].[itemcategory] ([id], [categoryname]) VALUES (4, N'Consumable')
SET IDENTITY_INSERT [dbo].[itemcategory] OFF
SET IDENTITY_INSERT [dbo].[itemlog] ON 

INSERT [dbo].[itemlog] ([id], [itemid], [resourceid], [itemprice], [itemdiscount], [itemfinalprice], [accountid], [qty], [accountbalb], [accountbala], [currency], [date]) VALUES (17, 1, N'123123', 30, 0, 30, 1, 1, 1000, 970, N'star', CAST(0x4B3F0B00 AS Date))
INSERT [dbo].[itemlog] ([id], [itemid], [resourceid], [itemprice], [itemdiscount], [itemfinalprice], [accountid], [qty], [accountbalb], [accountbala], [currency], [date]) VALUES (18, 2, N'123123', 30, 0, 330, 1, 11, 970, 640, N'star', CAST(0x4B3F0B00 AS Date))
INSERT [dbo].[itemlog] ([id], [itemid], [resourceid], [itemprice], [itemdiscount], [itemfinalprice], [accountid], [qty], [accountbalb], [accountbala], [currency], [date]) VALUES (20, 1, N'123123', 40, 0, 40, 1, 1, 9800, 9760, N'moon', CAST(0x4B3F0B00 AS Date))
INSERT [dbo].[itemlog] ([id], [itemid], [resourceid], [itemprice], [itemdiscount], [itemfinalprice], [accountid], [qty], [accountbalb], [accountbala], [currency], [date]) VALUES (21, 1, N'123123', 30, 0, 30, 1, 1, 640, 610, N'star', CAST(0x4B3F0B00 AS Date))
SET IDENTITY_INSERT [dbo].[itemlog] OFF
SET IDENTITY_INSERT [dbo].[itemmall] ON 

INSERT [dbo].[itemmall] ([itemid], [itemname], [itemimage], [itemtype], [itemdiscount], [itempricemoon], [itemseal], [itempricestar], [itemdesc], [isSet], [itemvalue1], [itemvalue2], [itemvalue3], [itemvalue4], [itemvalue5], [itemvalue6], [itemsetopt]) VALUES (1, N'Rain Coat222', N'costume_rain.png', 1, 0, 1, 0, 1, N'Lorem ipsum', 1, N'Full Set;123123;box.png;30;40;', N'Head;123123;head.png;30;40;Dexterity +3, Vitality +2', N'Body;123123;head.png;30;40;Dexterity +3,     Vitality +2', N'Glove;123123;head.png;30;40;', N'Boots;123123;head.png;30;40 ', NULL, N'Strength +12
Dexterity +12
Vitality +18
Intelligence +12
Wisdom +12
Physical Defense +5%
MP Recovery +8            ')
INSERT [dbo].[itemmall] ([itemid], [itemname], [itemimage], [itemtype], [itemdiscount], [itempricemoon], [itemseal], [itempricestar], [itemdesc], [isSet], [itemvalue1], [itemvalue2], [itemvalue3], [itemvalue4], [itemvalue5], [itemvalue6], [itemsetopt]) VALUES (2, N'EXP 100%', N'belt22.png', 4, 0, 1, 1, 1, N'', 0, N'belt2icon.png;123123;belt2icon.png;30;40;', N'Back;123123;head.png;30;40 ', NULL, NULL, NULL, NULL, N'Strength +12
Dexterity +12
Vitality +18
Intelligence +12
Wisdom +12
Physical Defense +5%
MP Recovery +8            ')
INSERT [dbo].[itemmall] ([itemid], [itemname], [itemimage], [itemtype], [itemdiscount], [itempricemoon], [itemseal], [itempricestar], [itemdesc], [isSet], [itemvalue1], [itemvalue2], [itemvalue3], [itemvalue4], [itemvalue5], [itemvalue6], [itemsetopt]) VALUES (15, N'asd', N'asd.png', 1, 0, 1, 0, 1, N'', 0, N'asd;123;box.png;30;40', N'', N'', N'', N'', N'', NULL)
INSERT [dbo].[itemmall] ([itemid], [itemname], [itemimage], [itemtype], [itemdiscount], [itempricemoon], [itemseal], [itempricestar], [itemdesc], [isSet], [itemvalue1], [itemvalue2], [itemvalue3], [itemvalue4], [itemvalue5], [itemvalue6], [itemsetopt]) VALUES (17, N'Test', N'costume_rain.png', 1, 0, 1, 0, 1, N'asd', 0, N'Box ; 123123 ;box.png; 35 ; 47 ; Strength +100', NULL, NULL, NULL, NULL, NULL, N'Strength +122
Dexterity +12
Vitality +18
Intelligence +12
Wisdom +12
Physical Defense +5%
MP Recovery +8            ')
INSERT [dbo].[itemmall] ([itemid], [itemname], [itemimage], [itemtype], [itemdiscount], [itempricemoon], [itemseal], [itempricestar], [itemdesc], [isSet], [itemvalue1], [itemvalue2], [itemvalue3], [itemvalue4], [itemvalue5], [itemvalue6], [itemsetopt]) VALUES (18, N'asdsds', N'costume_rain.png', 1, 0, 1, 1, 1, N'asds', 0, N'asdsd;123123;icon.png;30;40', NULL, NULL, NULL, NULL, NULL, N'Strength +12
Dexterity +12
Vitality +18
Intelligence +12
Wisdom +12
Physical Defense +5%
MP Recovery +8            ')
SET IDENTITY_INSERT [dbo].[itemmall] OFF
SET IDENTITY_INSERT [dbo].[media] ON 

INSERT [dbo].[media] ([id], [mediaimage]) VALUES (1, N'ss1.jpg')
INSERT [dbo].[media] ([id], [mediaimage]) VALUES (2, N'ss2.jpg')
INSERT [dbo].[media] ([id], [mediaimage]) VALUES (3, N'ss2.jpg')
INSERT [dbo].[media] ([id], [mediaimage]) VALUES (4, N'ss1.jpg')
SET IDENTITY_INSERT [dbo].[media] OFF
SET IDENTITY_INSERT [dbo].[news] ON 

INSERT [dbo].[news] ([id], [title], [categoryname], [date], [content]) VALUES (1, N'Server Opening', N'Notice', CAST(0xCD3E0B00 AS Date), N'<p>a</p>
')
SET IDENTITY_INSERT [dbo].[news] OFF
ALTER TABLE [dbo].[itemlog] ADD  CONSTRAINT [DF_itemlog_date]  DEFAULT (getdate()) FOR [date]
GO
ALTER TABLE [dbo].[news] ADD  CONSTRAINT [DF_news_date]  DEFAULT (getdate()) FOR [date]
GO
USE [master]
GO
ALTER DATABASE [Luna_WebDB] SET  READ_WRITE 
GO
